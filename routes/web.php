<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\CallerController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\QueueTypeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UnitController;
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

Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/data', function () {
    $user = User::all();

    return DataTables::of($user)->make();
})->name('data');

Route::get('/console/{id}/{id2}/{id3}', [AntrianController::class, 'index'])->name('antrian.console');

Route::get("/antrian/{unit}", [AntrianController::class, "getAntrian"]);

Route::resource('/loket', LoketController::class);
Route::get('/data/loket', [LoketController::class, "data"])->name('loket.data');
Route::get('/data/unit', [UnitController::class, "data"])->name('unit.data');
Route::get('/data/antrian', [AntrianController::class, "data"])->name('antrian.data');

Route::get('/display/{loket_id}', [DisplayController::class, 'index']);
Route::get('/caller/{loket_id}', [CallerController::class, 'index']);

Route::get("/nextQueue", [AntrianController::class, "nextQueue"])->name('antrian.next');
Route::get("/repeatQueue", [AntrianController::class, "repeatQueue"])->name('antrian.repeat');
Route::get("/updateStatus", [AntrianController::class, "updateStatus"])->name('antrian.status.update');
Route::get('/', [MenuController::class, 'index']);

Route::resource('/dashboard/unit', UnitController::class);
Route::get('/dashboard/setting', [SettingController::class, 'index'])->name('setting.index');

Route::get('/dashboard/chart', [ChartController::class, 'index']);

Route::resource('/dashboard/jenis-antrian', QueueTypeController::class)->parameters([
    'jenis-antrian' => 'queueType'
]);

Route::controller(QueueTypeController::class)->group(function(){
    Route::get('/dashboard/datatable/jenis-antrian', 'getDatatableJson')->name('jenis-antrian.datatable');
    Route::get('/dashboard/data-json/jenis-antrian','dataJson')->name('jenis-antrian.dataJson');

});
