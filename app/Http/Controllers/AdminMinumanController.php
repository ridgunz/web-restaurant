<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMinumanController extends Controller
{
     // set index page view
	public function indexMinuman() {
		return view('admin.list-minuman');
	}

	// handle fetch all makanan ajax request
	public function fetchAllMinuman() {
		$emps = Menu::where('kategori','Minuman')->orderBy('is_active','desc')->get();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Is Active</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->image . '" width="50" class="img-thumbnail"></td>
                <td>' . $emp->nama . '</td>
                <td>' . $emp->deskripsi . '</td>
                <td>' . $emp->amount . '</td>
                <td>' . $emp->stock . '</td>
                <td>' . $emp->is_active . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editMinumanModal"><i class="bi-pencil-square h4"></i></a>

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

    	// handle insert a new minuman ajax request
	public function storeMinuman(Request $request) {
		$file = $request->file('image');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$empData = [ 'nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Minuman'];
		Menu::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle edit an menu ajax request
	public function editMinuman(Request $request) {
		$id = $request->id;
		$emp = Menu::find($id);
		return response()->json($emp);
	}

	// handle update menu ajax request
	public function updateMinuman(Request $request) {
		$fileName = '';
		$emp = Menu::find($request->minuman_id);
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->avatar) {
				Storage::delete('public/images/' . $emp->image);
			}
		} else {
			$fileName = $request->minuman_image;
		}

		$empData = ['nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Minuman'];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle delete an employee ajax request
	public function deleteMinuman(Request $request) {
		$id = $request->id;
		$emp = Menu::find($id);
		if (Storage::delete('public/images/' . $emp->image)) {
			Menu::destroy($id);
		}
	}
}
