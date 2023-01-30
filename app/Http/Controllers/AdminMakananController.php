<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMakananController extends Controller
{
    // set index page view
	public function index() {
		return view('admin.list-menu');
	}

	// handle fetch all makanan ajax request
	public function fetchAll() {
		$emps = Menu::where('kategori','Makanan')->orderBy('is_active','desc')->get();
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
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editMakananModal"><i class="bi-pencil-square h4"></i></a>

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

    	// handle insert a new makanan ajax request
	public function store(Request $request) {
		if($request-> file('image') != null)
		{
			$file = $request->file('image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
		}else
		{
			$fileName = '';
		}

		$empData = [ 'nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Makanan'];
		Menu::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle edit an menu ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$emp = Menu::find($id);
		return response()->json($emp);
	}

	// handle update menu ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = Menu::find($request->makanan_id);
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->image) {
				Storage::delete('public/images/' . $emp->image);
			}
		} else {
			$fileName = $request->makanan_image;
		}

		$empData = ['nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Makanan'];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle delete an employee ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$emp = Menu::find($id);
		if($emp->image != null)
		{
			if (Storage::delete('public/images/' . $emp->image)) {
				Menu::destroy($id);
			}
		}else
		{
			Menu::destroy($id);
		}
	}
}
