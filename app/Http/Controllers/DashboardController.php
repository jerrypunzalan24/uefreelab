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
        $check = \DB::select('accounts')->where('username',$request->username)->get();
        if(password_verify($request->password, $check[0]->password)){
          $request->session()->put("admin_login",true);
          $request->session()->put("username", $request->username);
          return redirect('/dashboard');
        }
      }
      return view('adminside.adminloginpage',['navbar'=>true]);

    }
    public function allstudents(Request $request){
      return view('adminside.allstudents',['allstudents'=>true]);
    }
    public function insidethelab(Request $request){
      return view('adminside.insidethelab',['insidethelab'=>true]);
    }
    public function laboratories(Request $request){
      return view('adminside.laboratories',['laboratories'=>true,'admin'=>true]);
    }
    public function labsched(Request $request){
      return view('adminside.labsched',['labsched'=>true,'admin'=>true]);
    }
    public function accounts(Request $request){
      return view('adminside.accounts',['accounts'=>true,'admin'=>true]);
    }
}
