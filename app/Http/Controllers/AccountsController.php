<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
  public function add(Request $request){
    \DB::table('accounts')->insertgetId([
      'firstname' => $request->firstname,
      'lastname'  => $request->lastname,
      'username'  => $request->username,
      'password'  => password_hash($request->password,PASSWORD_DEFAULT),
      'role'      => $request->role]);
    return redirect('dashboard/accounts');
  }
  public function edit(Request $request){
    if($request->newpassword == "" && $request->oldpassword == ""){
      \DB::table('accounts')->where('id',$request->id)->update([
        'firstname' => $request->firstname,
        'lastname'  => $request->lastname,
        'username'  => $request->username,
        'role'      => $request->role
      ]);
    }
    else{
      \DB::table('accounts')->where('id',$request->id)->update([
        'password' => $request->newpass]);
    }
    return redirect('dashboard/accounts');
  }
  public function delete(Request $request){
    \DB::table('accounts')->where('id',$request->id)->delete();
    return redirect('dashboard/accounts');
  }
}
