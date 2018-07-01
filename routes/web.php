  <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', "ReserveController@login");
Route::any('/stepone',"ReserveController@stepone");
Route::any('/success',"ReserveController@success");
Route::post('/getschedule',"AjaxController@getschedule");
Route::post('/getterminals', "AjaxController@getterminals");
Route::post('/filterterminal', "AjaxController@filterterminal");

Route::any("/login","DashboardController@index");
Route::group(['prefix'=>'/dashboard', 'middleware' =>'login'],function(){
  Route::post('/check', "AjaxController@check");
  Route::get('/logout','DashboardController@logout');
  Route::get('/','DashboardController@insidethelab');
  Route::post('/timeout','DashboardController@timeout');
  Route::get('/allstudents','DashboardController@allstudents');
  Route::get('/allstudents/print','DashboardController@print');
  Route::get('/print','DashboardController@print');
  Route::group(['middleware'=>'admin_only'],function(){
    Route::group(['prefix'=>'/accounts',],function(){
      Route::get('/','DashboardController@accounts');
      Route::post('/add','AccountsController@add');
      Route::post('/edit','AccountsController@edit');
      Route::post('/delete','AccountsController@delete');
    });
    Route::group(['prefix'=>'/labsched'],function(){
      Route::get('/','DashboardController@labsched');
      Route::post('/add','LabschedController@add');
      Route::post('/edit','LabschedController@edit');
      Route::post('/delete','LabschedController@delete');
      Route::post('/upload','LabschedController@upload');
      Route::post('/deleteall','LabschedController@deleteall');
      Route::post('/filterlab','LabschedController@filterlab');
      Route::post('/getlabs','LabschedController@getlabs');
    });
    Route::group(['prefix'=>'/laboratories'],function(){
      Route::get('/','DashboardController@laboratories');
      Route::post('/add','LaboratoriesController@add');
      Route::post('/edit','LaboratoriesController@edit');
      Route::post('/delete','LaboratoriesController@delete');
    });
    Route::group(['prefix' =>'/terminal'], function(){
      Route::get('/','DashboardController@terminals');
      Route::post('/add', 'TerminalController@add');
      Route::post('/edit','TerminalController@edit');
      Route::post('/delete','TerminalController@delete');
      Route::post('/setiprange','TerminalController@setiprange');
      Route::post("/getallterminals", "AjaxController@getallterminals");
    });
  });
});