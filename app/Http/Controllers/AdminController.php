<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list()
    {
        return view('admin.list-menu', ['menu' => 'List Menu']);
    }

    public function tambah()
    {
        return view('admin.tambah-menu', ['menu' => 'Tambah Menu']);
    }

    public function laporan()
    {
        return view('admin.laporan', ['menu' => 'Laporan']);
    }

    public function absensi()
    {
        return view('admin.absensi', ['menu' => 'Absensi']);
    }
}
