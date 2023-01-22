<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Menu;

use App\Models\temp_order_cart;
use Auth;

class KasirController extends Controller
{
    public function order(){
        // $data = Menu::all();
        $makanan = Menu::where('kategori', 'Makanan')->get();
        $minuman = Menu::where('kategori', 'Minuman')->get();

        // print_r($data);die();
        return view('kasir.order', ['makanan' => $makanan,'minuman'=> $minuman]);
    }

    public function topping($pemesan,$tipe_pemesanan, $makanan, $harga, $id){

        // dd($request);{pemesan}/{tipe_pemesanan}/{makanan}/{id}/{harga}
        return view('kasir.topping', ['id' => $id, 'nama_makanan' => $makanan, 'pemesan' => $pemesan, 'tipe_pemesanan' => $tipe_pemesanan, 'harga' => $harga]);
    }

    public function place_order(Request $request){
        // Session(['id_kasir'=> 4]);
        // print_r($_POST);
        // echo $request->post('id_kasir');
        // $data = $request->session()->all();
        // echo Session('id_kasir');
        // dd($data);
        echo $_POST['id_kasir'];
        echo $_POST['pemesan'];
        echo $_POST['tipe'];

        $insert = new temp_order_cart;

        $insert->kasir_id = $request->id_kasir;
        $insert->pemesan = $request->pemesan;
        $insert->tipe = $request->tipe;
        
        $insert->save();
    }

    public function preview_order(){
        return view('kasir.preview-order');
    }
}
