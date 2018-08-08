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

    $terminals = \DB::table('terminals')
    ->leftJoin('students','students.terminal_id1','=','terminals.terminal_id')
    ->whereRaw("((students.terminal_id1 is null) OR students.status = 1) AND terminals.lab_id = {$request->id}")
    ->orderBy('terminals.terminal_id','ASC')->get();
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
      <td><div class ='ui buttons' style ='width:100%'>
      <button class ='ui blue button editbtn lab' onclick = \"editentry({$terminal->lab_id},'terminal',this)\"><i class ='ui edit icon'></i>Edit</button>
      </div></td>
      </tr>";
    }
    return $terminalStr;
  }
  public function getallterminals(Request $request){
    $terminals = \DB::table('terminals')->orderByRaw("terminal_id ASC")->get();
    $response = "";
    foreach($terminals as $terminal){
      $response .= "<option value = '{$terminal->terminal_id}'>{$terminal->name}</option>";
    }
    return $response;
  }
  public function check(Request $request){
    $results = \DB::table('students')->join('terminals','students.terminal_id1','=','terminals.terminal_id')->where('status',0)->get();
    $response_html = "";
    foreach($results as $result){
      $active = $result->active === 0 ? "Active" : "Inactive";
      $response_html .= "<tr>
      <td>{$result->studentnumber}</td>
      <td>{$result->firstname} {$result->lastname}</td>
      <td>{$active}</td>
      <td>{$result->subject}</td>
      <td>{$result->course}</td>
      <td>{$result->time_in}</td>
      <td>{$result->name}</td>
      <td>
      <input type ='hidden' name ='id' value ='{$result->student_id}'/>
      <input type ='hidden' name ='studentnumber' value = '{$result->studentnumber}'>
      <a  class ='ui blue button ' onclick = 'timeout({$result->student_id}, {$result->studentnumber})' style ='padding:8px;' ><i class ='ui times icon'></i>Time out</a>
      </td>
      </tr>";
    }
    return $response_html;
  }
}
