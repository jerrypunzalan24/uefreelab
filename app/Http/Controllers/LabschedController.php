<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class LabschedController extends Controller
{
  public function add(Request $request){
    \DB::table('reserved_lab')->insertgetId([
      'description' => $request->schedname == "" ? "Available schedule" : $request->schedname,
      'lab_id' => $request->lab,
      'time_in' => $request->timein,
      'time_out'=>$request->timeout,
      'status' => $request->status,
      'schedule' => $request->schedule]);
    return redirect('/dashboard/labsched')->with('success','Entry has been added');
  }
  public function edit(Request $request){
    \DB::table('reserved_lab')->where('reserved_lab_id',$request->id)->update([
      'description' => $request->schedname == "" ? "Available schedule" : $request->schedname,
      'status' => $request->status,
      'schedule' => $request->schedule,
      'time_in' => $request->timein,
      'time_out' => $request->timeout]);
    return redirect('dashboard/labsched')->with('success','Edit success');
  }
  public function delete(Request $request){
    \DB::table('reserved_lab')->where('reserved_lab_id', $request->id)->delete();
    return redirect('dashboard/labsched')->with('success','Entry has been deleted');
  }
  public function upload(Request $request){
    $reader = null;
    if(strrchr($request->importsched, ".") == '.xls')
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    else if(strrchr($request->importsched, ".") == '.xlsx')
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($request->importsched);
    $dataArray = $spreadsheet->getActiveSheet()->toArray();
    $labs = \DB::table('labs')->get();
    $labArray = array();
    foreach($labs as $lab)
      $labArray[$lab->lab_name] = $lab->lab_id;
    // Inserting 'Not available' schedules
    for($i = 1; $i < count($dataArray); $i++){
      if(strlen(implode($dataArray[$i])) == 0)
        break;

      print_r($dataArray[$i]);
      $timein =  date("H:i:s", strtotime(explode("-",$dataArray[$i][5])[0]));
      $timeout = date("H:i:s", strtotime(explode("-",$dataArray[$i][5])[1]));
      $room = explode(" ", $dataArray[$i][6]);
      $description = $dataArray[$i][1];
      $days = $dataArray[$i][4];
      if(count($room) != 2){
        $room = implode("",array_slice(explode(" ", $dataArray[$i][6]), 1,2));
      }
      else if(!empty(trim($dataArray[$i][7]))){
        $room = explode(" ", $dataArray[$i][7])[1];
      }
      if(!empty(trim($dataArray[$i][7])) && array_key_exists($room, $labArray)){
        \DB::table('reserved_lab')->insertgetId([
          'time_in'=> $timein,
          'time_out' => $timeout,
          'lab_id' => $labArray[strtoupper(trim($room))],
          'description' => $description,
          'schedule' => $days,
          'status' => 1,
        ]);
      }
    }
    // Inserting 'Available schedules'
    $starttime = "07:00:00"; // Assuming that lab opens at 7:00 AM
    $endtime = "17:00:00"; // Assuming that lab closes at 7:00 PM
    $currentsched = "MWF";
    $currentid = 0;
    $results = \DB::table('reserved_lab')->join('labs','reserved_lab.lab_id','=','labs.lab_id')->orderByRaw("lab_name ASC, schedule ASC, time_in ASC")->get();
    foreach($results as $result){
      if($currentsched != $result->schedule){
        // if the last schedule is not equal to 7:00 PM, add the last available schedule.
        if($starttime !== $endtime || $currentid != $result->lab_id){
          \DB::table('reserved_lab')->insertgetId([
            'time_in' => $starttime,
            'time_out' => $endtime,
            'description' => 'Available schedule',
            'lab_id' => $result->lab_id,
            'schedule' => $currentsched,
            'status' => 0]);
        }
        $starttime = "07:00:00"; // Reset to 7:00 AM if the schedule becomes different
      }
      if($starttime !== $result->time_in){
        \DB::table('reserved_lab')->insertgetId([
          'time_in' => $starttime,
          'time_out' => $result->time_in,
          'description' => 'Available schedule',
          'lab_id' => $result->lab_id,
          'schedule' => $result->schedule,
          'status' => 0,
        ]);
      }
      $starttime = $result->time_out;
      $currentsched = $result->schedule;
      $currentid = $result->lab_id;
    }
    return redirect('dashboard/labsched')->with('success','Upload success');
  }
  public function deleteall(Request $request){
    $reserved_labs = \DB::table('reserved_lab')->get();
    foreach($reserved_labs as $reserved_lab){
      \DB::table('students')->where('reserved_lab_id',$reserved_lab->reserved_lab_id)->delete();
    }
    \DB::table('reserved_lab')->delete();
    return redirect('dashboard/labsched');
  }
  public function filterlab(Request $request){
    $response_html = '';
    $results = \DB::table('reserved_lab')
    ->join('labs','labs.lab_id','=','reserved_lab.lab_id')
    ->where('labs.lab_name',$request->value)
    ->orderByRaw("labs.lab_name ASC, reserved_lab.schedule ASC, reserved_lab.time_in ASC")->get();
    foreach($results as $result){
      $status = $result->status == 0 ? "Available" : "Not available" ;
      $desc = $result->description === "" ? "Available Schedule" : $result->description;
      $response_html .= "<tr>
      <td><b id = 'timer'>{$result->time_in} - {$result->time_out}</td>
      <td>{$desc}</td>
      <td id = 'labname'>{$result->lab_name}</td>
      <td id = 'status'>{$status}</td>
      <td id = 'schedule'>{$result->schedule}</td>
      <td><div class ='ui buttons'>
      <button class ='ui blue button editbtn labsched' onclick = \"editentry({$result->reserved_lab_id},'labsched',this)\"><i class ='ui edit icon'></i>Edit</button>
      <button class ='ui red button' onclick = \"deleteentry({$result->reserved_lab_id})\"><i class ='ui trash icon'></i>Delete</button>
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
