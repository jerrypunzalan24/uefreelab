<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
      return view('adminside.allstudents',['allstudents'=>true]);
    }
    public function insidethelab(Request $request){
      $results = \DB::table('students')
      ->join('reserved_lab','reserved_lab.reserved_lab_id','=','students.reserved_lab_id')
      ->join('terminals','terminals.terminal_id','=','students.terminal_id1')
      ->where('students.status',0)->get();
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
      return view('adminside.labsched',['labsched'=>true,
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
    public function accounts(Request $request){
      return view('adminside.accounts',['accounts'=>true,
        'admin' => true,
        'role'  => $request->session()->get("role")
      ]);
    }
}
