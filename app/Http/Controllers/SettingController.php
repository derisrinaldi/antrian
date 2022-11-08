<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        # code...
        $instansi = Instansi::first();
        $data=['instansi'=>$instansi];
        return view('pages.settings.index',$data);
    }
}
