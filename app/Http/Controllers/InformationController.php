<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        return view('Information.index', [
            "title" => "Informasi Pegawai",
        ])
        ;
    }
}
