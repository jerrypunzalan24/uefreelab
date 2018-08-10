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
      'role'      => $request->role
    ]);
    return redirect('dashboard/accounts')->with('success','Entry has been added');
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
        'password' => password_hash($request->newpass,PASSWORD_DEFAULT)]);
    }
    return redirect('dashboard/accounts')->with('success','Edit success');
  }
  public function update(Request $request){
   $output = shell_exec(" git pull");
   if(!strcmp($output,"Already up to date.")){
    return redirect('dashboard/accounts')->with("success","Updated successfully");
   }
   return redirect('dashboard/accounts')->with('success',$output);
  }
  public function delete(Request $request){
    \DB::table('accounts')->where('id',$request->id)->delete();
    return redirect('dashboard/accounts')->with('success','Entry has been deleted');
  }
}
