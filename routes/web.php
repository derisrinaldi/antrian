<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\LoketController;
use App\Models\Loket;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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

Route::get('/', function () {
    return view('layouts.admin.app');
});

Route::get('/dashboard',function(){
    return view('pages.loket.index',['title'=>'Loket']);
});

Route::get('/data',function(){
    $user = User::all();

    return DataTables::of($user)->make();
})->name('data');

Route::get('/antrian',function(){
    return view('pages.antrianadmisi.index');
});

Route::get("/antrian/{unit}",[AntrianController::class,"getAntrian"]);
Route::get('/tiket',function(){
    return view('pages.antrianadmisi.tiket');
});

Route::resource('/loket',LoketController::class);
Route::get('/data/loket',[LoketController::class,"data"])->name('loket.data');

Route::get('/display',function(){
    return view('layouts.display.app');
});

Route::get('/t/{no}/{loket}',function($no,Loket $loket){
    event(new \App\Events\SendMessage($loket->loket_name,$no));
    dd("event send");
});