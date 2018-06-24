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
}
