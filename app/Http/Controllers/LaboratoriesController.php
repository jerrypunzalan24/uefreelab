<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratoriesController extends Controller
{
  public function add(Request $request){
    $id = \DB::table('labs')->insertgetId([
      'lab_name' => $request->labname,
      'lab_capacity' => $request->capacity]);
    for($i = 1; $i<=$request->capacity; $i++){
      \DB::table('terminals')->insertgetID([
        'name'=> "{$request->labname}-{$i}",
        'lab_id' => $id,
        'ip' => ""
      ]);
    }
    return redirect('dashboard/laboratories')->with('success','Entry has been added');
  }
  public function edit(Request $request){
    $labs = \DB::table('labs')->where('lab_id', $request->id)->get();
    if($labs[0]->lab_capacity < $request->capacity){
      for($i = $labs[0]->lab_capacity+1; $i<=$request->capacity; $i++){
        \DB::table('terminals')->insertgetId([
          'name' => "{$request->labname}-{$i}",
          'lab_id' => $request->id,
          'ip' => ''
        ]);
      }
    }
    else if($labs[0]->lab_capacity > $request->capacity){
      for($i = $request->capacity; $i<=$labs[0]->lab_capacity;$i++){
        \DB::table('students')->join('terminals','terminals.terminal_id','=','students.terminal_id1')
        ->where('terminals.name', "{$request->labname}-{$i}")->delete();
        \DB::table('terminals')->where('name', "{$request->labname}-{$i}")->delete();
      }
    }
    \DB::table('labs')->where('lab_id',$request->id)->update([
      'lab_name' => $request->labname,
      'lab_capacity' => $request->capacity
    ]);
    return redirect('dashboard/laboratories')->with('success','Edit success');
  }
  public function delete(Request $request){
    $terminals = \DB::table('terminals')->where('terminal_id', $request->id)->get();
    foreach($terminals as $terminal)
      \DB::table('students')->where('terminal_id1', $terminal->terminal_id)->delete();
    \DB::table('reserved_lab')->where('lab_id', $request->id)->delete();
    \DB::table('labs')->where('lab_id', $request->id)->delete();
    return redirect('dashboard/laboratories')->with('success','Entry has been deleted');
  }
}
