<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabschedController extends Controller
{
    public function add(Request $request){
      \DB::table('reserved_lab')->insertgetId([
        'lab_id' => $request->lab,
        'time_in' => $request->timein,
        'time_out'=>$request->timeout,
        'status' => $request->status,
        'schedule' => $request->schedule]);
      return redirect('/dashboard/labsched');
    }
    public function edit(Request $request){
      \DB::table('reserved_lab')->where('reserved_lab_id',$request->id)->update([
        'status' => $request->status,
        'schedule' => $request->schedule,
        'time_in' => $request->timein,
        'time_out' => $request->timeout]);
      return redirect('dashboard/labsched');
    }
    public function delete(Request $request){
      \DB::table('reserved_lab')->where('reserved_lab_id', $request->id)->delete();
      return redirect('dashboard/labsched');
    }
    public function upload(Request $request){

    }
    public function deleteall(Request $request){
      \DB::table('reserved_lab')->delete();
      return redirect('dashboard/labsched');

    }
    public function filterlab(Request $request){
      $response_html = '';
      $results = \DB::table('reserved_lab')->join('labs','labs.lab_id','=','reserved_lab.lab_id')->where('labs.lab_name',$request->value)->get();
      foreach($results as $result){
        $status = $result->status == 0 ? "Available" : "Not available" ;
        $response_html .= "<tr>
        <td><b id = 'timer'>{$result->time_in} - {$result->time_out}</td>
        <td id = 'labname'>{$result->lab_name}</td>
        <td id = 'status'>{$status}</td>
        <td id = 'schedule'>{$result->schedule}</td>
        <td><div class ='ui buttons'>
              <button class ='ui blue button editbtn labsched' onclick = \"editentry({$result->reserved_lab_id},'labsched',this)\">Edit</button>
              <button class ='ui red button' onclick = \"deleteentry({$result->reserved_lab_id})\">Delete</button>
            </div></td>
              </tr>";
      }
      return $response_html;
    }
    public function getlabs(Request $request){
      $results = \DB::table('labs')->get();
      $response = "";
      foreach($results as $result){
        $response .= "<option value ='{$result->lab_id}'>{$result->lab_name}</option>";
      }
      return $response;
    }
}
