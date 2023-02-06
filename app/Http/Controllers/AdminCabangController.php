<?php

namespace App\Http\Controllers;
use App\Models\Cabang;
use Illuminate\Http\Request;

class AdminCabangController extends Controller
{
       // set index page view
	public function indexCabang() {
		return view('admin.cabang');
	}

	// handle fetch all cabang ajax request
	public function fetchAllCabang() {
		$emps = Cabang::orderBy('is_active','desc')->get();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Cabang</th>
                <th>Aktif</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->nama_cabang . '</td>
                <td>' . $emp->is_active . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCabangModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

    	// handle insert a new Cabang ajax request
	public function storeCabang(Request $request) {

		$empData = [ 'nama_cabang' => $request->nama_cabang, 'is_active' => $request->is_active];
		Cabang::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle edit an cabang ajax request
	public function editCabang(Request $request) {
		$id = $request->id;
		$emp = Cabang::find($id);
		return response()->json($emp);
	}

	// handle update cabang ajax request
	public function updateCabang(Request $request) {
		$emp = Cabang::find($request->cabang_id);

		$empData = ['nama_cabang' => $request->nama_cabang, 'is_active' => $request->is_active];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle delete an employee ajax request
	public function deleteCabang(Request $request) {
		$id = $request->id;
		$emp = Cabang::find($id);

			Cabang::destroy($id);
		
	}
}
