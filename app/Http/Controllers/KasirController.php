<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Menu;

class KasirController extends Controller
{
    public function order(){
        // $data = Menu::all();
        $makanan = Menu::where('kategori', 'Makanan')->get();
        $minuman = Menu::where('kategori', 'Minuman')->get();

        // print_r($data);die();
        return view('kasir.order', ['makanan' => $makanan,'minuman'=> $minuman]);
    }

    public function topping(Request $request){
        // dd($request);{id_kasir}/{pemesan}/{tipe_pemesanan}/{makanan}/{id}/{harga}
        return view('kasir.topping', ['id' => $request->id, 'nama_makanan' => $request->makanan, 'id_kasir' => $request->id_kasir, 'pemesan' => $request->pemesan, 'tipe_pemesanan' => $request->tipe_pemesanan, 'harga' => $request->harga]);
    }

    public function place_order(Request $request){
        // Session(['id_kasir'=> 4]);
        // print_r($_POST);
        // echo $request->post('id_kasir');
        // $data = $request->session()->all();
        // echo Session('id_kasir');
        // dd($data);
    }

    public function preview_order(){
        return view('kasir.preview-order');
    }
}
