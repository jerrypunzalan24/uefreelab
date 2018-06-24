<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratoriesController extends Controller
{
    public function add(Request $request){
      \DB::table('labs')->insertgetId([
        'lab_name' => $request->labname,
        'lab_capacity' => $request->capacity]);
      return redirect('dashboard/laboratories')->with('success','Entry has been added');
    }
    public function edit(Request $request){
      \DB::table('labs')->where('lab_id',$request->id)->update([
        'lab_name' => $request->labname,
        'lab_capacity' => $request->capacity
      ]);
      return redirect('dashboard/laboratories')->with('success','Edit success');
    }
    public function delete(Request $request){
      \DB::table('labs')->where('lab_id', $request->id)->delete();
      return redirect('dashboard/laboratories')->with('success','Entry has been deleted');
    }
}
