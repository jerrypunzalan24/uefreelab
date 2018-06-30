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
9. terminals
*/
use Codedge\Fpdf\Facades\Fpdf;
class DashboardController extends Controller
{
  public function index(Request $request){
    $hostip = substr($request->server("HTTP_HOST"), 0,strrpos($request->server("HTTP_HOST"), ":"));
    if($request->ip() === $hostip)
      return redirect('/');
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
    $results = \DB::table('labs')->orderBy('lab_name','ASC')->get();
    return view('adminside.laboratories',['laboratories'=>true,
      'admin' => true,
      'role'  => $request->session()->get("role"),
      'results' => $results]);
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
    $results = \DB::table('accounts')->get();
    return view('adminside.accounts',[
      'accounts'=>true,
      'admin' => true,
      'role'  => $request->session()->get("role"),
      'results' => $results
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
    ->whereRaw("studentnumber = {$request->studentnumber1} AND status = 1")->get();
    $student = \DB::table('students')->join('reserved_lab','students.reserved_lab_id','=','reserved_lab.reserved_lab_id')
    ->whereRaw("students.student_id = {$request->id1} AND students.status = 0")->get();
    $timein = strtotime($student[0]->time_in)/(60*60);
    $timeout = strtotime(date("H:i:s"))/(60*60);
    \DB::table('students')->where('studentnumber',$request->studentnumber1)->update([
      'time_out'=> date("G:i:s"),
      'status' => 1,
      'hours'=> \DB::raw("hours + " . ($timeout - $timein)),
      'active'=> 1]);
    return redirect('dashboard');
  }
  public function print(Request $request){
    $results = \DB::table('students')
    ->join('reserved_lab','reserved_lab.reserved_lab_id','=','students.reserved_lab_id')
    ->join('terminals','terminals.terminal_id','=','students.terminal_id1')->selectRaw('*, reserved_lab.time_out as lab_time_out, students.time_out as student_time_out')
    ->orderBy('student_id','DESC')->get();
    Fpdf::AddPage("P");
    Fpdf::SetFont("Arial","B",14);
    Fpdf::Image("./assets/img/rnd-logo.png",95,10,20,20);
    Fpdf::Ln(25);
    Fpdf::Cell(0,1,"University of the East Freelab System", 0,0,'C');
    Fpdf::Ln();
    Fpdf::SetFont("Arial","",14);
    Fpdf::Cell(0,25,"Report created - " . date("F d, Y g:i A (l)"),0,0,'C');
    Fpdf::Ln();
    Fpdf::SetFont("Arial","B",10);
    Fpdf::Cell(45,10,'Fullname',1,0,'C');
    Fpdf::Cell(30,10,'Student number',1,0,'C');
    Fpdf::Cell(18,10, 'Course',1,0,'C');
    Fpdf::Cell(20,10,'Time in',1,0,'C');
    Fpdf::Cell(20,10,'Time out',1,0,'C');
    Fpdf::Cell(20,10,'Terminal',1,0,'C');
    Fpdf::Cell(20,10,'Hours',1,0,'C');
    Fpdf::Cell(20,10,'Count',1,0,'C');
    Fpdf::SetFont("Arial","",10);
    Fpdf::Ln();
    foreach($results as $result){
      Fpdf::Cell(45,10,"{$result->firstname} {$result->lastname}",1,0,'C');
      Fpdf::Cell(30,10,$result->studentnumber,1,0,'C');
      Fpdf::Cell(18,10,$result->course,1,0,'C');
      Fpdf::Cell(20,10,$result->time_in,1,0,'C');
      Fpdf::Cell(20,10,$result->student_time_out,1,0,'C');
      Fpdf::Cell(20,10,$result->name, 1,0,'C');
      Fpdf::Cell(20,10,$result->hours,1,0,'C');
      Fpdf::Cell(20,10,$result->count,1,0,'C');
      Fpdf::Ln();
    }
    return response(Fpdf::Output(),200)->header("Content-type","application-pdf");
  }
  public function terminals(Request $request){
    $buttons =\DB::table('labs')->orderByRaw('lab_id ASC')->get();
    $results = \DB::table('terminals')->orderByRaw('terminal_id ASC')->get();
    return view('adminside.terminal', ['results' => $results,
      'admin'=>true,
      'role'=> $request->session()->get('role'),
      'buttons' => $buttons,
      'terminals' => true]);
  }
}
