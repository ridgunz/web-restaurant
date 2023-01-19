<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function order(){
        return view('kasir.order');
    }

    public function topping(Request $request){
        // dd($request);{id_kasir}/{pemesan}/{tipe_pemesanan}/{makanan}/{id}/{harga}
        return view('kasir.topping', ['id' => $request->id, 'nama_makanan' => $request->makanan, 'id_kasir' => $request->id_kasir, 'pemesan' => $request->pemesan, 'tipe_pemesanan' => $request->tipe_pemesanan, 'harga' => $request->harga]);
    }

    public function place_order(Request $request){
        print_r($_POST);
    }
}
