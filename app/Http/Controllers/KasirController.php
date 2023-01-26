<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Session;
use App\Models\Menu;

use App\Models\Order;

use App\Models\temp_order_cart;
use App\Models\temp_order_detail_cart;
use App\Models\temp_order_topping_cart;

use Auth;

class KasirController extends Controller
{   
    // private $cart_cout = temp_order_detail_cart::get()->count();
    public function order(){
        // $data = Menu::all();
        $makanan = Menu::where('kategori', 'Makanan')->get();
        $minuman = Menu::where('kategori', 'Minuman')->get();

        $count_cart = temp_order_detail_cart::get()->count();

        // print_r($data);die();
        return view('kasir.order', ['makanan' => $makanan,'minuman'=> $minuman, 'count_cart' => $count_cart]);
    }

    public function topping($makanan, $harga, $id){

        $count_cart = temp_order_detail_cart::get()->count();

        $topping = Menu::where('kategori', 'Topping')->get();
        // dd($request);{pemesan}/{tipe_pemesanan}/{makanan}/{id}/{harga}
        return view('kasir.topping', ['id' => $id, 'nama_makanan' => $makanan, 'harga' => $harga, 'count_cart' => $count_cart, 'topping' => $topping]);
    }

    public function place_order(Request $request){
        // Session(['id_kasir'=> 4]);
        // $topping = json_decode($_POST['topping']);
        // $topping = count($topping);
        // print_r($_POST);die();  
        // echo $request->post('id_kasir');
        // $data = $request->session()->all();
        // echo Session('id_kasir');
        // dd($data);
        // echo $_POST['id_kasir'];
        // echo $_POST['pemesan'];
        // echo $_POST['tipe'];

        // DB::transaction(function (Request $request) {
            $insert = new temp_order_cart;
            $insert->kasir_id = $request->id_kasir;
            // $insert->pemesan = $request->pemesan;
            // $insert->tipe = $request->tipe;
            $insert->save();

            $id_temp = $insert->id;

            $insert_detail = new temp_order_detail_cart;
            $insert_detail->id_makanan = $request->id_makanan;
            $insert_detail->id_temp_order_cart = $id_temp;
            $insert_detail->save();
            $id_insert_detail = $insert_detail->id;

            if($_POST['topping']){
                foreach (json_decode($_POST['topping']) as $key => $value) {
                    $insert_detail_topping = new temp_order_topping_cart;
                    $insert_detail_topping->id_topping = $value;
                    $insert_detail_topping->id_temp_order_detail = $id_insert_detail;
                    $insert_detail_topping->save();
                }
            }
        // });
    }

    public function preview_order(){
        $count_cart = temp_order_detail_cart::get()->count();

        $total_price = 0;


        $cart = DB::table('temp_order_detail_cart')
                ->select('temp_order_detail_cart.id as id_detail_cart', 'menu.*')
                ->join('menu', 'temp_order_detail_cart.id_makanan', '=', 'menu.id')
                ->get();


        foreach ($cart as $key => $value) {
            $price = $value->amount;
            $total_price += $value->amount;
            $cart[$key]->topping = DB::table('temp_order_detail_topping_cart')
            ->where('id_temp_order_detail', '=', $value->id_detail_cart)
            ->join('menu', 'temp_order_detail_topping_cart.id_topping', '=', 'menu.id')
            ->get();


            foreach($cart[$key]->topping as $key2=> $value2){
                $total_price += $value2->amount;
                $price += $value2->amount;
            }

            $cart[$key]->price = $price;
        }
        
        

        // echo "<pre>";
        // print_r($cart);
        // echo "</pre>";
        // die();

        return view('kasir.preview-order', ['cart' => $cart,'count_cart' => $count_cart, 'total_price' => $total_price]);
    }

    public function delete_order(){
        $cart = temp_order_detail_cart::find($_POST['id_detail']);
        // echo "<pre>";
        // echo $_POST['id_detail'];
        // print_r($cart);
        // echo "</pre>";
        // die();


        $deleted = $cart->delete();

        if($deleted){
            $data = array(
                'status' => 200,
                'msg' => 'Sukses menghapus pembelian'
            );
            echo json_encode($data);
        }else{

            $data = array(
                'status' => 200,
                'msg' => 'Gagal menghapus pembelian'
            );
            echo json_encode($data);
        }

        // return view('kasir.preview-order', ['cart' => $cart,'count_cart' => $count_cart]);
    }

    public function submit_order(){
        $id_kasir = Auth::user()->id;
        $cart = DB::table('temp_order_cart')
        ->select('temp_order_cart.id as id_cart', 'temp_order_detail_cart.id as id_detail_cart', 'temp_order_detail_topping_cart.id as id_topping_cart', 'temp_order_detail_cart.*', 'temp_order_detail_topping_cart.*')
        ->where('temp_order_cart.kasir_id', $id_kasir)
        ->leftJoin('temp_order_detail_cart', 'temp_order_detail_cart.id_temp_order_cart','=','temp_order_cart.id')
        ->leftJoin('temp_order_detail_topping_cart', 'temp_order_detail_topping_cart.id_temp_order_detail','=','temp_order_detail_cart.id')
        ->get();


        foreach ($cart as $key => $value) {
            // $order[$value->id_cart] = array('tipe_order' => 1, 'nama_pemesan' => 'Andika');
            $order[$value->id_cart][$value->id_detail_cart][$value->id_topping_cart] = $value->id_topping;
        }

        // dd($order);die();

        foreach ($order as $key => $value) {
            $insert_cart = new Order;
            $insert_cart->user_id = $id_kasir;
            $insert_cart->tipe_order = 1;
            $insert_cart->nama_pemesan = 'Andika';
            $insert_cart->flag_selesai = 0;
            $insert_cart->save();
        }
        // ->toSql();

        // $cart_detail = 

        // dd($cart);
        // dd($order);
    }
}
