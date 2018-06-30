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
      WHERE students.reserved_lab_id = reserved_lab.reserved_lab_id AND students.status = 0
      ) AS reserve_count FROM reserved_lab 
      JOIN labs ON labs.lab_id = reserved_lab.lab_id WHERE reserved_lab.lab_id = {$request->lab_id}");
    return $sched;
  }
  public function getterminals(Request $request){

    $terminalStr ="";
    $terminals = \DB::table('terminals')->leftJoin('students','students.terminal_id1','=','terminals.terminal_id')->whereRaw("(students.terminal_id1 is null OR students.status = 1) AND terminals.lab_id = {$request->id}")->orderBy('terminals.terminal_id','ASC')->get();
    foreach($terminals as $terminal){
      $terminalStr .= "<option value = '{$terminal->terminal_id}'>{$terminal->name}</option>";
    }
    return $terminalStr;
  }
  public function filterterminal(Request $request){
    $terminals = \DB::table('terminals')->whereRaw("name LIKE '%{$request->name}%'")->get();
    $terminalStr = "";
    foreach($terminals as $terminal){
      $terminalStr .= "<tr>
      <td><b>{$terminal->name}</b></td>
      <td id ='ipAddress'>{$terminal->ip}</td>
      <td><div class ='ui buttons'>
      <button class ='ui blue button editbtn lab' onclick = \"editentry({$terminal->lab_id},'terminal',this)\">Edit</button>
      <button class ='ui red button' onclick = \"deleteentry({ $terminal->lab_id })\">Delete</button>
      </div></td>
      </tr>";
    }
    return $terminalStr;
  }
}
