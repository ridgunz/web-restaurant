<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DapurController extends Controller
{
    public function index(){
        $order = DB::table('order')
                ->select('order.*')
                ->join('order_detail', 'order_detail.order_id', '=', 'order.id')
                ->where('flag', 0)
                ->groupBy('order.id')
                ->get();
        return view('dapur.dapur', ['order' => $order]);
    }

    public function detail($id){
        // $order = Order::where('flag_selesai', 0)->get();
        $order = DB::table('order_detail')
                ->select('nama','order_id', 'order_detail.id')
                ->join('menu', 'order_detail.id_makanan', '=', 'menu.id')
                ->where('order_id', $id)
                ->get();


        foreach ($order as $key => $value) {
            $order[$key]->topping = DB::table('order_detail_topping')
            ->select('nama')
            ->where('order_detail_id', '=', $value->id)
            ->join('menu', 'order_detail_topping.id_topping', '=', 'menu.id')
            ->get();

        }

        // echo json_encode($order);die();  
        return view('dapur.dapur_detail', ['order' => $order]);
    }

    public function update_flag_order(Request $request){
        $id = $request->id;
        $flag = $request->flag;
        if($flag == 1){
            $msg = 'Anda telah menyelesaikan seluruh pesanan';
        }
        
        DB::table('order')
            ->where('id', '=', $id)
            ->update(['flag_selesai' => $flag]);

        $res = array(
            'status' => 200,
            'msg' => $msg
        );

        echo json_encode($res);
    }

    public function update_flag_order_detail(Request $request){
        $id = $request->id;
        $flag = $request->flag;
        if($flag == 1){
            $msg = 'Sukses menyelesaikan pesanan';
        }else{
            $msg = 'Sukses membatalkan pesanan';
        }
        
        DB::table('order_detail')
            ->where('id', '=', $id)
            ->update(['flag' => $flag]);

        $res = array(
            'status' => 200,
            'msg' => $msg
        );

        echo json_encode($res);
    }
    
}
