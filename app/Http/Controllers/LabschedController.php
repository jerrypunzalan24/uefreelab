<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class LabschedController extends Controller
{
  public function add(Request $request){
    \DB::table('reserved_lab')->insertgetId([
      'lab_id' => $request->lab,
      'time_in' => $request->timein,
      'time_out'=>$request->timeout,
      'status' => $request->status,
      'schedule' => $request->schedule,
      'description' => '']);
    return redirect('/dashboard/labsched')->with('success','Entry has been added');
  }
  public function edit(Request $request){
    \DB::table('reserved_lab')->where('reserved_lab_id',$request->id)->update([
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
    $temptimeout = "";
    for($i = 1; $i <= count($dataArray); $i++){
      if(strlen(implode($dataArray[$i])) == 0)
        break;
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
        if($timein !== $temptimeout){
          \DB::table('reserved_lab')->insertgetId([
            'time_in' => $temptimeout,
            'time_out' => $timein,
            'lab_id' => $labArray[strtoupper(trim($room))],
            'description' => 'Available schedule',
            'schedule' => $days,
            'status' => 0]);
        }
        \DB::table('reserved_lab')->insertgetId([
          'time_in'=> $timein,
          'time_out' => $timeout,
          'lab_id' => $labArray[strtoupper(trim($room))],
          'description' => $description,
          'schedule' => $days,
          'status' => 1,
        ]);
      }
      $temptimeout = $timeout;
    }
    return redirect('dashboard/labsched')->with('success','Upload success');
  }
  public function deleteall(Request $request){
    \DB::table('reserved_lab')->delete();
    echo "Delete success";
    return redirect('dashboard/labsched');

  }
  public function filterlab(Request $request){
    $response_html = '';
    $results = \DB::table('reserved_lab')
    ->join('labs','labs.lab_id','=','reserved_lab.lab_id')
    ->where('labs.lab_name',$request->value)
    ->orderByRaw("reserved_lab.time_in ASC")->get();
    foreach($results as $result){
      $status = $result->status == 0 ? "Available" : "Not available" ;
      $response_html .= "<tr>
      <td><b id = 'timer'>{$result->time_in} - {$result->time_out}</td>
      <td>{$result->description}</td>
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
