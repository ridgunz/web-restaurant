<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAkunController extends Controller
{
     // set index page view
	public function indexAkun() {
		return view('admin.manage-account');
	}

    // handle fetch all akun ajax request
	public function fetchAllAkun() {
		$emps = User::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->username . '</td>
                <td>' . $emp->level . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editAkunModal"><i class="bi-pencil-square h4"></i></a>

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

    public function storeAkun(Request $request) {
      
		//validate form
        // $validated = $request->validate([
        //     'name'     => 'required',
        //     'username'     => 'required', 'unique:users',
        //     'level'     => 'required',
        //     'password'   => 'required','string', 'min:8', 'confirmed',
        //     'confirm-password'   => 'required','string', 'min:8', 'same:password'
        // ]);

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'username'     => 'required|unique:users',
            'level'     => 'required',
            'password'   => 'required|string|min:6',
        ]);

         //check if validation fails
         if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $user = User::create([
            'name'     => $request->name,
            'username'     => $request->username,
            'level'   => $request->level,
            'password'   => Hash::make($request->password),
        ]);

		return response()->json([
			'status' => 200,
		]);
	}

    public function editAkun(Request $request) {
		$id = $request->id;
		$emp = User::find($id);
		return response()->json($emp);
	}

    	// handle update akun ajax request
	public function updateAkun(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'level'     => 'required',
            'password'   => 'required|string|min:6',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

		$emp = User::find($request->akun_id);
        $emp->update([
            'name' => $request->name,'level' => $request->level,'password' => Hash::make($request->password)
        ]);
		
        // $empData = ['name' => $request->name,'username' => $request->username,'level' => $request->level,'password' => Hash::make($request->password)];

		// $emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

     // handle delete an akun ajax request
	public function deleteAkun(Request $request) {
		$id = $request->id;
		$emp = User::find($id);
        if($emp->level != '3' && auth()->user()->id != $emp->id)
        {   
            User::destroy($id);
        }else
        {
            return response()->json([
                'status' => 400,
                'message' => 'Tidak bisa delete akun admin!'
            ]);
        }
	}

}
