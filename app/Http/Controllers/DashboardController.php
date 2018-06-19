<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
Table of contents
1. index
2. allstudents
3. insidethelab
4. laboratories
5. labsched
6. accounts
7. logout
8. timeout
*/
class DashboardController extends Controller
{
  public function index(Request $request){
    if($request->session()->has('admin_login')){
      return redirect('/dashboard');
    }
    if($request->has('submit')){
      $check = \DB::table('accounts')->where('username',$request->username)->get();
      if(password_verify($request->password, $check[0]->password)){
        $request->session()->put("admin_login",true);
        $request->session()->put("username", $request->username);
        $request->session()->put("role", $check[0]->role == 0 ? true : false);
        return redirect('/dashboard');
      }
    }
    return view('adminside.adminloginpage',['navbar'=>true]);

  }
  public function allstudents(Request $request){
    $results = \DB::table('students')
    ->join('reserved_lab','reserved_lab.reserved_lab_id','=','students.reserved_lab_id')
    ->join('terminals','terminals.terminal_id','=','students.terminal_id1')->selectRaw('*, reserved_lab.time_out as lab_time_out, students.time_out as student_time_out')
    ->where('students.status',1)->orderBy('student_id','DESC')->get();
    return view('adminside.allstudents',['allstudents'=>true,
      'results'=>$results,
      'role'=>$request->session()->get("role")
    ]);
  }
  public function insidethelab(Request $request){
    $results = \DB::table('students')
    ->join('reserved_lab','reserved_lab.reserved_lab_id','=','students.reserved_lab_id')
    ->join('terminals','terminals.terminal_id','=','students.terminal_id1')
    ->where('students.status',0)->orderBy('student_id','DESC')->get();
    return view('adminside.insidethelab',['insidethelab'=>true,
      'results' => $results,
      'role'    => $request->session()->get("role")]);
  }
  public function laboratories(Request $request){
    return view('adminside.laboratories',['laboratories'=>true,
      'admin' => true,
      'role'  => $request->session()->get("role")]);
  }
  public function labsched(Request $request){
    $results = \DB::table('reserved_lab')->join('labs','reserved_lab.lab_id','=','labs.lab_id')->orderByRaw("lab_name ASC, time_in ASC, schedule ASC")->get();
    $buttons = \DB::table('labs')->orderByRaw("lab_name ASC")->get();
    return view('adminside.labsched',['labsched'=>true,
      'admin' => true,
      'role'  => $request->session()->get("role"),
      'results' => $results,
      'buttons' => $buttons
    ]);
  }
  public function accounts(Request $request){
    return view('adminside.accounts',['accounts'=>true,
      'admin' => true,
      'role'  => $request->session()->get("role")
    ]);
  }
  public function logout(Request $request){
    $request->session()->forget("admin_login");
    $request->session()->forget("username");
    $request->session()->forget("role");
    return redirect('/login');
  }
  public function timeout(Request $request){
    $checkifexist = \DB::table('students')
    ->whereRaw("studentnumber = {$request->studentnumber} AND status = 1")->get();
    $student = \DB::table('students')->join('reserved_lab','students.reserved_lab_id','=','reserved_lab.reserved_lab_id')
    ->whereRaw("students.student_id = {$request->id} AND students.status = 0")->get();
    $timein = strtotime($student[0]->time_in)/(60*60);
    $timeout = strtotime(date("G:i:s"))/(60*60);
    \DB::table('students')->where('studentnumber',$request->studentnumber)->update([
      'time_out'=> date("G:i:s"),
      'status' => 1,
      'hours'=> \DB::raw("hours + " . ($timeout - $timein))]);
    return redirect('dashboard');
  }
}
