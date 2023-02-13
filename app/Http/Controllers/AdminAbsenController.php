<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use Illuminate\Http\Request;
use App\Models\Cabang;

class AdminAbsenController extends Controller
{
      // set index page view
	public function indexAbsen() {
    $cabangs = Cabang::where('is_active','Yes')->get();

		return view('admin.absensi',compact('cabangs'));
	}

    public function fetchAllAbsen()
    {
        $emps = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.updated_at','cabang.nama_cabang')
        ->leftjoin('users','users.id','absensi.users_id')
        ->leftjoin('cabang','cabang.id','absensi.cabang_id')
        ->orderBy('absensi.created_at','desc')
        ->get();
        $output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Cabang</th>
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
                <td>' . $emp->nama_cabang . '</td>
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

  public function fetchAllAbsenx(Request $request)
  {
    {
      if($request->ajax())
      {
       if($request->from_date != '' && $request->to_date != '' && $request->cabang != '')
       {
        $data = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.updated_at','cabang.nama_cabang')
          ->leftjoin('users','users.id','absensi.users_id')
          ->leftjoin('cabang','cabang.id','absensi.cabang_id')
          ->where('absensi.cabang_id', $request->cabang)
          ->whereBetween('absensi.created_at', array($request->from_date, $request->to_date))
          ->orderBy('absensi.created_at','desc')
          ->get();

          echo json_encode($data);
       }
     }
  }
}

}
