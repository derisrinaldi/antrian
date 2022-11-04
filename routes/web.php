<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\CallerController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\MenuController;
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

Route::get('/dashboard',function(){
    return view('pages.loket.index',['title'=>'Loket']);
});

Route::get('/data',function(){
    $user = User::all();

    return DataTables::of($user)->make();
})->name('data');

Route::get('/console/{id}',[AntrianController::class,'index'])->name('antrian.console');

Route::get("/antrian/{unit}",[AntrianController::class,"getAntrian"]);

Route::resource('/loket',LoketController::class);
Route::get('/data/loket',[LoketController::class,"data"])->name('loket.data');

Route::get('/display',function(){
    return view('layouts.display.app');
});

Route::get('/caller/{unit_id}/{loket_id}',[CallerController::class,'index']);

Route::get("/nextQueue",[AntrianController::class,"nextQueue"])->name('antrian.next');
Route::get("/repeatQueue",[AntrianController::class,"repeatQueue"])->name('antrian.repeat');
Route::get("/updateStatus",[AntrianController::class,"updateStatus"])->name('antrian.status.update');
Route::get('/',[MenuController::class,'index']);