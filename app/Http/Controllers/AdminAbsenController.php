<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use Illuminate\Http\Request;

class AdminAbsenController extends Controller
{
      // set index page view
	public function indexAbsen() {

		return view('admin.absensi');
	}

    public function fetchAllAbsen()
    {
        $emps = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.updated_at')
        ->join('users','users.id','absensi.users_id')->get();
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
       if($request->from_date != '' && $request->to_date != '')
       {
        $data = Absen::select('absensi.id','users.name','users.level','absensi.created_at','absensi.updated_at')
        ->join('users','users.id','absensi.users_id')
          ->whereBetween('absensi.created_at', array($request->from_date, $request->to_date))
          ->get();

          echo json_encode($data);
       }
     }
  }
}

}
