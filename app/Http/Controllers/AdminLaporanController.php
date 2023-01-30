<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function indexLaporan() {

        return view('admin.laporan');
	}

    public function fetchAllOrder()
    {
        $emps = DB::select("SELECT 
        DISTINCT
        o.id,
        CASE WHEN o.tipe_order = '1' THEN 'Bungkus'
        WHEN o.tipe_order  = '2' THEN 'Makan di Tempat'
        ELSE tipe_order END as tipe_order,
        GROUP_CONCAT(m.nama) as menu,
        o.tipe_pembayaran,
        o.total_pembayaran,
        u.name,
        CASE WHEN u.level = '1' THEN 'Kasir'
        WHEN u.level = '2' THEN 'Dapur'
        WHEN u.`level` = '3' THEN 'Admin'
        ELSE u.`level` END as level,
        o.created_at,
        o.updated_at 
        FROM `order` o
        JOIN users u ON o.user_id = u.id 
        JOIN order_detail od ON o.id = od.order_id 
        JOIN menu m ON m.id = od.id_makanan 
        WHERE o.flag_selesai = 1
        GROUP BY o.id,
        o.tipe_order,o.tipe_pembayaran,
        o.total_pembayaran,
        u.name,u.`level`,o.created_at,
        o.updated_at ");

        $output = '';
		if (!empty($emps)) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tipe Order</th>
                <th>Menu</th>
                <th>Tipe Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>User</th>
                <th>level</th>
                <th>Created at</th>
                <th>Updated at</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->tipe_order . '</td>
                <td>' . $emp->menu . '</td>
                <td>' . $emp->tipe_pembayaran . '</td>
                <td>' . $emp->total_pembayaran . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->level . '</td>
                <td>' . $emp->created_at . '</td>
                <td>' . $emp->updated_at . '</td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
    }

  public function fetchAllOrderx(Request $request)
  {
    {
      if($request->ajax())
      {
       if($request->from_date != '' && $request->to_date != '')
       {
            $data = DB::select("SELECT 
            DISTINCT
            o.id,
            CASE WHEN o.tipe_order = '1' THEN 'Bungkus'
            WHEN o.tipe_order  = '2' THEN 'Makan di Tempat'
            ELSE tipe_order END as tipe_order,
            GROUP_CONCAT(m.nama) as menu,
            o.tipe_pembayaran,
            o.total_pembayaran,
            u.name,
            CASE WHEN u.level = '1' THEN 'Kasir'
            WHEN u.level = '2' THEN 'Dapur'
            WHEN u.`level` = '3' THEN 'Admin'
            ELSE u.`level` END as level,
            o.created_at,
            o.updated_at 
            FROM `order` o
            JOIN users u ON o.user_id = u.id 
            JOIN order_detail od ON o.id = od.order_id 
            JOIN menu m ON m.id = od.id_makanan 
            WHERE o.flag_selesai = 1 AND
            o.created_at BETWEEN ? AND ?
            GROUP BY o.id,
            o.tipe_order,o.tipe_pembayaran,
            o.total_pembayaran,
            u.name,u.`level`,o.created_at,
            o.updated_at",[$request->from_date, $request->to_date]);

          echo json_encode($data);
       }
     }
  }
}
}
