<?php

use App\Models\User;
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