<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ReserveController extends Controller
{
  public function login(Request $request){
    $request->session()->forget('terminal');
    $request->session()->forget('student');
    $hostip = substr($request->server("HTTP_HOST"), 0,strrpos($request->server("HTTP_HOST"), ":"));
    echo $hostip;
    if($request->ip() === $hostip){
      if($request->has('btnSubmit')){
        $check = \DB::table('students')->whereRaw("studentnumber = '{$request->studentnumber}' AND status = 0")->get();
        if(count($check)==0){
          $request->session()->put("student", array( "firstname" => $request->fname,
            "lastname"      => $request->lname,
            "studentnumber" => $request->studentnumber,
            "course"        => $request->course,
            "subject"       => $request->subject
          ));
          return redirect('/stepone');
        }
        return redirect('/')->with('error',$request->studentnumber);
      }
      return view('login',['home'=>true,]);
    }
    $checkterminal = \DB::table('terminals')->where("ip", $request->ip())->get();
    if(count($checkterminal) == 0){
        return view('error',['message' => 'This device is not registered in this system.']);
    }
    if($request->has('verify')){
      $getterminal= \DB::table('students')->where('studentnumber',$request->studentnumber)->selectRaw("*, terminal_id1 AS terminal_id")->get();
      $check = \DB::table('terminal')->where('terminal_id', $getterminal[0]->terminal_id);
      if(count($check) != 0){
        \DB::table('students')->whereRaw("studentnumber = '{$request->studentnumber}'")->update(['active'=>0]);
        return redirect('/')->with('message', "Success! Enjoy using this terminal");
      }
      else{
        return redirect('/')->with('error',"Your assigned terminal is {$getterminal->terminal_name}");
      }
    }
    return view('sync');
  }
  public function stepone(Request $request){
    if($request->session()->has('student')){
      if($request->has('submit')){
        $lab_id = \DB::table('labs')
        ->join('reserved_lab','labs.lab_id','=','reserved_lab.lab_id')
        ->where('reserved_lab.reserved_lab_id',$request->reserved_lab_id)->get();
        $terminal = \DB::select("SELECT * FROM terminals
          LEFT JOIN students ON terminals.terminal_id = students.terminal_id1
          WHERE students.terminal_id1 is null AND terminals.lab_id = {$lab_id[0]->lab_id} OR students.count > 1 ORDER BY terminal_id ASC");
        $request->session()->put("terminal", $terminal[0]->name);
        $checkifexist = \DB::table('students')->where('studentnumber', $request->session()->get('student')['studentnumber'])->get();
        if(count($checkifexist)==1){
          \DB::table('students')->where('studentnumber',$request->session()->get('student')['studentnumber'])
          ->update([
            'subject'         => $request->session()->get("student")['subject'],
            'reserved_lab_id' => $request->reserved_lab_id,
            'terminal_id1'    => $terminal[0]->terminal_id,
            'time_out'        => "00:00:00",
            'status'          => 0,
            'count'           => \DB::raw("count + 1"),
            'active' => 1
          ]);
        }
        else{
          \DB::table('students')->insertgetId([
            'studentnumber'   => $request->session()->get('student')['studentnumber'],
            'firstname'       => $request->session()->get('student')['firstname'],
            'lastname'        => $request->session()->get('student')['lastname'],
            'subject'         => $request->session()->get('student')['subject'],
            'course'          => $request->session()->get('student')['course'],
            'reserved_lab_id' => $request->reserved_lab_id,
            'terminal_id1' => $terminal[0]->terminal_id,
            'status' => '0',
            'count' => 1,
            'hours' => 0.0,
            'time_out' => "00:00:00",
            'active' => 1
          ]);
        }
        return redirect('/success');
      }
      $results = \DB::table('labs')->get();
      $currenttime = date("F d, Y g:i A (l)");
      return view('reserve',['results'=>$results,'currenttime'=>$currenttime,'navbar'=>true]);
    }
    return redirect("/");
  }
  public function success(Request $request){
    $terminal = $request->session()->get('terminal');
    $request->session()->forget('terminal');
    $request->session()->forget('student');
    return view('success',['terminal'=>$terminal]);
  }
  public function back(){
    $request->session()->forget('student');
  }
}
