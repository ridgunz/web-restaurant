<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\Absen;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

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

    public function indexAbsenDapur(){

        return view('dapur.absen-dapur');
    }

    public function fetchAllAbsenDapur()
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

  public function fetchAllAbsenDapurx(Request $request)
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

    public function checkinDapur(){
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

    public function checkoutDapur(){
        $id = Auth::user()->id;
        $data = Absen::whereDate('created_at', '=', date('Y-m-d'))
        ->where('users_id',$id)
        ->where('flag_checkin','1')
        ->where('flag_checkout','0')
        ->get();

        if(!empty($data->count() > 0)){

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
