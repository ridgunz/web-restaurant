<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Menu;
use DataTables;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
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

    public function getMenu(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('menu')
            ->where('kategori','Makanan')
            ->where('is_active',1)
            ->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getMinuman(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('menu')
            ->where('kategori','Minuman')
            ->where('is_active',1)
            ->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getTopping(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('menu')
            ->where('kategori','Topping')
            ->where('is_active',1)
            ->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
