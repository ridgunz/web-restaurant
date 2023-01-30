<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Session;
use App\Models\Menu;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_detail_topping;

use App\Models\temp_order_cart;
use App\Models\temp_order_detail_cart;
use App\Models\temp_order_topping_cart;
use App\Models\Absen;
use Carbon\Carbon;

use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;

use Mike42\Escpos\PrintConnectors\RawbtPrintConnector;


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
            $insert = new temp_order_cart;
            $insert->kasir_id = $request->id_kasir;
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
    }

    public function place_order_minuman(Request $request){
        $insert = new temp_order_cart;
        $insert->kasir_id = $request->id_kasir;
        $insert->save();

        $id_temp = $insert->id;

        $insert_detail = new temp_order_detail_cart;
        $insert_detail->id_makanan = $request->id_makanan;
        $insert_detail->id_temp_order_cart = $id_temp;
        $insert_detail->save();
        $id_insert_detail = $insert_detail->id;
}

public function place_order_minuman_add(Request $request){
    $id_order = $request->id;

    $insert_detail = new Order_detail;
    $insert_detail->id_makanan = $request->id_makanan;
    $insert_detail->order_id = $id_order;
    $insert_detail->save();
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

    public function submit_order(Request $request){
        // print_r($_POST);die();
        $id_kasir = Auth::user()->id;
        $cart = DB::table('temp_order_cart')
        ->select('temp_order_cart.id as id_cart', 'temp_order_detail_cart.id as id_detail_cart', 'temp_order_detail_topping_cart.id as id_topping_cart', 'temp_order_detail_cart.*', 'temp_order_detail_topping_cart.*')
        ->where('temp_order_cart.kasir_id', $id_kasir)
        ->leftJoin('temp_order_detail_cart', 'temp_order_detail_cart.id_temp_order_cart','=','temp_order_cart.id')
        ->leftJoin('temp_order_detail_topping_cart', 'temp_order_detail_topping_cart.id_temp_order_detail','=','temp_order_detail_cart.id')
        ->get();


        foreach ($cart as $key => $value) {
            // $order[$value->id_cart] = array('tipe_order' => 1, 'nama_pemesan' => 'Andika');
            $order[$value->id_cart][$value->id_detail_cart][$value->id_makanan][$value->id_topping_cart] = $value->id_topping;
        }

        // print_r($order);die();


        if(isset($order)){
                $insert_cart = new Order;
                $insert_cart->user_id = $id_kasir;
                $insert_cart->tipe_order = $request->tipePesanan;
                $insert_cart->nama_pemesan = $request->namaPemesan;
                $insert_cart->flag_selesai = 0;
                $insert_cart->save();
                $id_order = $insert_cart->id;

                foreach ($order as $key => $value) {
                    foreach ($value as $key2 => $value2) {
                        foreach ($value2 as $key3 => $value3) {
                            $insert_detail = new Order_detail;
                            $insert_detail->id_makanan = $key3;
                            $insert_detail->order_id = $id_order;
                            $insert_detail->save();
                            $id_order_detail = $insert_detail->id;

                                foreach ($value3 as $key4 => $value4) {
                                    if($value4){
                                    $insert_detail_topping = new Order_detail_topping;
                                    $insert_detail_topping->order_detail_id = $id_order_detail;
                                    $insert_detail_topping->id_topping = $value4;
                                    $insert_detail_topping->save();
                                }
                            }
                    }
                }
            }
        }

        temp_order_cart::where('kasir_id',$id_kasir)->delete();

        $res = array(
            'status' => 200,
            'msg' => 'Pemesanan Berhasil'
        );
        
        echo json_encode($res);
    }
    public function delete_order_add(){
        $cart = Order_detail::find($_POST['id_detail']);
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

    public function list_order(){
        $order = DB::table('order')
                ->select('order.*')
                ->join('order_detail', 'order_detail.order_id', '=', 'order.id')
                ->where('order.flag_selesai', 0)
                ->groupBy('order.id')
                ->get();

        $count_cart = temp_order_detail_cart::get()->count();
        return view('kasir.list_order', ['order' => $order,'count_cart' => $count_cart]);
    }

    public function payment_order($id){
        $count_cart = temp_order_detail_cart::get()->count();
        $total_price = 0;


        $order = DB::table('order')
        ->where('id', $id)
        ->first();
        // echo json_encode($order);
// die();
        $order->detail = DB::table('order_detail')
                ->select('order_detail.id as id_detail_cart', 'menu.*')
                ->join('menu', 'order_detail.id_makanan', '=', 'menu.id')
                ->where('order_id', $id)
                ->get();

        foreach ($order->detail as $key => $value) {
            $price = $value->amount;
            $total_price += $value->amount;
            $order->detail[$key]->topping = DB::table('order_detail_topping')
            ->where('order_detail_id', '=', $value->id_detail_cart)
            ->join('menu', 'order_detail_topping.id_topping', '=', 'menu.id')
            ->get();


            foreach($order->detail[$key]->topping as $key2=> $value2){
                $total_price += $value2->amount;
                $price += $value2->amount;
            }

            $order->detail[$key]->price = $price;
        }

        // echo json_encode($order);
        // die();


        return view('kasir.payment_order', ['id' => $id,'order' => $order,'count_cart' => $count_cart, 'total_price' => $total_price]);
    }

    public function complete_order(Request $request){
        $id = $request->id;
        $flag = 1;  
        if($flag == 1){
            $msg = 'Anda telah menyelesaikan seluruh pesanan';
        }
        
        DB::table('order')
            ->where('id', '=', $id)
            ->update(['flag_selesai' => 1, 'tipe_pembayaran' => $request->tipePembayaran, 'total_pembayaran' => $request->total]);

        $res = array(
            'status' => 200,
            'msg' => $msg
        );
        // $this->print_order($id);
        echo json_encode($res);
    }

    public function add_order($id){
        
        $makanan = Menu::where('kategori', 'Makanan')->get();
        $minuman = Menu::where('kategori', 'Minuman')->get();

        $count_cart = temp_order_detail_cart::get()->count();

        // print_r($data);die();
        return view('kasir.order_add', ['id' => $id,'makanan' => $makanan,'minuman'=> $minuman, 'count_cart' => $count_cart]);
    }

    public function add_order_topping($id, $makanan, $harga, $id_makanan){

        $count_cart = temp_order_detail_cart::get()->count();

        $topping = Menu::where('kategori', 'Topping')->get();
        // dd($request);{pemesan}/{tipe_pemesanan}/{makanan}/{id}/{harga}
        return view('kasir.topping_add', ['id' => $id, 'id_makanan' => $id_makanan, 'nama_makanan' => $makanan, 'harga' => $harga, 'count_cart' => $count_cart, 'topping' => $topping]);
    }

    public function submit_order_add(Request $request){
        // echo json_encode($_POST);die();

        $insert_detail = new Order_detail;
        $insert_detail->id_makanan = $request->id_makanan;
        $insert_detail->order_id = $request->id;
        $insert_detail->save();
        $id_order_detail = $insert_detail->id;
        if($request->topping){
            foreach (json_decode($request->topping) as $key => $value) {
                $insert_detail_topping = new Order_detail_topping;
                $insert_detail_topping->order_detail_id = $id_order_detail;
                $insert_detail_topping->id_topping = $value;
                $insert_detail_topping->save();
            }
        }

        $res = array(
            'status' => 200,
            'msg' => 'Pemesanan Berhasil'
        );
        
        echo json_encode($res);
    }


    public function print_order(Request $request){
        $total_price = 0;

        $order = DB::table('order')
        ->where('id', $request->id)
        ->first();

        $order->detail = DB::table('order_detail')
                ->select('order_detail.id as id_detail_cart', 'menu.*')
                ->join('menu', 'order_detail.id_makanan', '=', 'menu.id')
                ->where('order_id', $request->id)
                ->get();

        foreach ($order->detail as $key => $value) {
            $price = $value->amount;
            $total_price += $value->amount;
            $order->detail[$key]->topping = DB::table('order_detail_topping')
            ->where('order_detail_id', '=', $value->id_detail_cart)
            ->join('menu', 'order_detail_topping.id_topping', '=', 'menu.id')
            ->get();

            
            foreach($order->detail[$key]->topping as $key2=> $value2){
                $total_price += $value2->amount;
                $price += $value2->amount;
            }

            $order->detail[$key]->price = $price;
        }

        $items = array();
        foreach ($order->detail as $key => $value) {
            array_push($items, new item($value->nama, number_format($value->amount)));

            if($value->topping){

                foreach ($value->topping as $key => $value) {
                    array_push($items, new item("+".$value->nama, number_format($value->amount)));
                }
            }
        }

        
        array_push($items, new item("\nTotal Harga", number_format($total_price)));


        $profile = CapabilityProfile::load("POS-5890");
        $connector = new RawbtPrintConnector();
        $printer = new Printer($connector, $profile);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Bakso Simpang Tugu\n\n");
        $printer->text("Jl. Mayjen H.R. Edi Sukma\nCiawi, Kec. Ciawi, Kabupaten \nBogor\n\nTelpon : 0812-8457-4121\n\n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setEmphasis(true);
        $printer->text("Pesanan\n");
        $printer->setEmphasis(false);
        foreach ($items as $item) {
            $printer->text($item->getAsString(32)); 
        }
        $printer->text("\n\n");
        $printer->close();

    }

}

class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->dollarSign = $dollarSign;
    }

    public function getAsString($width = 48)
    {
        $rightCols = 10;
        $leftCols = $width - $rightCols;
        if ($this->dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);

        $sign = ($this->dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

    public function __toString()
    {
        return $this->getAsString();
    }

    public function indexAbsenKasir(){

        return view('kasir.absen-kasir');
    }

    public function fetchAllAbsenKasir()
    {
        $id = Auth::user()->id;
        $emps = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.checkout')
        ->join('users','users.id','absensi.users_id')
        ->where('users.id',$id)
        ->get();
        $output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Check In</th>
                <th>Check Out</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->level . '</td>
                <td>' . $emp->created_at . '</td>
                <td>' . $emp->checkout . '</td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
    }

  public function fetchAllAbsenKasirx(Request $request)
  {
    {
      if($request->ajax())
      {
       if($request->from_date != '' && $request->to_date != '')
       {
        $id = Auth::user()->id;
        $data = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.checkout')
        ->join('users','users.id','absensi.users_id')
        ->where('users.id', $id)
          ->whereBetween('absensi.created_at', array($request->from_date, $request->to_date))
          ->get();

          echo json_encode($data);
       }
     }
  }
}

    public function checkinKasir(){
        $id = Auth::user()->id;
        $data = Absen::whereDate('created_at', '=', date('Y-m-d'))
        ->where('users_id',$id)
        ->get();

        if(empty($data->count() > 0)){
            $absen = new Absen();
            $absen->users_id = $id;
            $absen->flag_checkin = 1;
            $absen->flag_checkout = 0;
            $absen->save();

            return response()->json([
                'status' => 200,
            ]);
        }else
        {
            return response()->json([
                'status' => 400,
                'msg' => 'Sudah checkin hari ini'
            ]);
        }
    }

    public function checkoutKasir(){
        $id = Auth::user()->id;
        $data = Absen::whereDate('created_at', '=', date('Y-m-d'))
        ->where('users_id',$id)
        ->where('flag_checkin','1')
        ->where('flag_checkout','0')
        ->get();

        if(!empty($data->count() > 0)){

            // $absen = Absen::findOrFail($id_absen->id);
            // $absen->checkout = Carbon::now();
            // $absen->flag_checkout = 1;
            // $absen->save();

            $update = DB::select('UPDATE absensi SET flag_checkout = 1, checkout = now() WHERE flag_checkout = 0 AND DATE(created_at) = CURDATE() AND users_id = ?',[$id]);

            return response()->json([
                'status' => 200,
            ]);
        }else
        {
            return response()->json([
                'status' => 400,
                'msg' => 'Sudah checkout hari ini'
            ]);
        }
    }
}
