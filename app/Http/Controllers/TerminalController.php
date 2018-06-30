<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function  edit(Request $request){
        \DB::table('terminals')->where('terminal_id', $request->id)->update([
          'ip' => $request->ipAdd]);
        return redirect('dashboard/terminal')->with('success','Edit success');
    }
    public function setiprange(Request $request){
    $start = $request->terminal;
    $end = $request->terminal1;
    $ipv4int = $this->iptoint($request->startip);
    for($i = $start; $i<= $end; $i++){
      \DB::table('terminals')->where('terminal_id', $i)->update([
        'ip'=> $this->iptostring($ipv4int)]);
      $ipv4int++;
    }
    return redirect('dashboard/terminal')->with('success','Assign success');
    }
    public function iptoint($ip){
      $iparr = explode(".", $ip);
      $firstoctet = intval($iparr[0]);
      $secoctet = intval($iparr[1]);
      $thirdoctet = intval($iparr[2]);
      $fourthoctet = intval($iparr[3]);
      return ($firstoctet * (256 * 256 * 256)) + ($secoctet * (256 * 256)) + ($thirdoctet * 256) + ($fourthoctet);
    }
    public function iptostring($ip){
      $firstoctet = ($ip >> 24) & 0xFF;
      $secoctet = ($ip >> 16) & 0xFF;
      $thirdoctet = ($ip >> 8) & 0xFF;
      $fourthoctet = $ip & 0xFF;
      return "{$firstoctet}.{$secoctet}.{$thirdoctet}.{$fourthoctet}";
    }
}
