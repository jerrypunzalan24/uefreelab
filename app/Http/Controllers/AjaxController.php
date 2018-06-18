<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
  public function getschedule(Request $request){
    $day = date("l")[0];
    $sched = \DB::select("SELECT *, (
      SELECT COUNT(*)
      FROM students 
      WHERE students.reserved_lab_id = reserved_lab.reserved_lab_id
    ) AS reserve_count FROM reserved_lab 
      JOIN labs ON labs.lab_id = reserved_lab.lab_id WHERE reserved_lab.lab_id = {$request->lab_id} AND reserved_lab.schedule LIKE '%{$day}%'");
    return $sched;
  }
}
