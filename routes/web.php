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
Route::any("/login","DashboardController@index");
Route::group(['prefix'=>'/dashboard', 'middleware' =>'login'],function(){
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
      Route::post('/add','LaboratoriesController@add');
      Route::post('/edit','LaboratoriesController@edit');
      Route::post('/delete','LaboratoriesController@delete');
      Route::post('/upload','LaboratoriesController@upload');
      Route::post('/deleteall','LaboratoriesController@deleteall');
    });
    Route::group(['prefix'=>'/labs'],function(){
      Route::get('/','DashboardController@laboratories');
      Route::post('/add','LaboratoriesController@add');
      Route::post('/edit','LaboratoriesController@edit');
      Route::post('/delete','LaboratoriesController@delete');
    });
  });
});
