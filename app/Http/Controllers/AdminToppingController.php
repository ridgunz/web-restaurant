<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminToppingController extends Controller
{
     // set index page view
	public function indexTopping() {
		$menus = Menu::where('kategori','Makanan')->get();
		$cabangs = Cabang::where('is_active','Yes')->get();

		return view('admin.list-topping', compact('menus','cabangs'));
	}

	// handle fetch all topping ajax request
	public function fetchAllTopping() {
		$emps = Menu::select('menu.id','menu.image','menu.nama','menu.deskripsi','menu.amount','cabang.nama_cabang','menu.stock','menu.is_active','menu.menus')
		->join('cabang','cabang.id','menu.cabang_id')
		->where('kategori','Topping')->orderBy('is_active','desc')
		->get();
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
								<th>Cabang</th>
                <th>Is Active</th>
								<th>Untuk Menu</th>
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
								<td>' . $emp->nama_cabang . '</td>
                <td>' . $emp->is_active . '</td>
								<td>' . $emp->menus . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editToppingModal"><i class="bi-pencil-square h4"></i></a>

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

	public function fetchAllToppingx(Request $request)
	{
		{
			if($request->ajax())
			{
			 if($request->cabang != '')
			 {
				$data = Menu::select('menu.id','menu.image','menu.nama','menu.deskripsi','menu.amount','cabang.nama_cabang','menu.stock','menu.is_active','menu.menus')
					->join('cabang','cabang.id','menu.cabang_id')
					->where('kategori','Topping')->orderBy('is_active','desc')
					->where('menu.cabang_id', $request->cabang)
					->get();

					echo json_encode($data);
			 }else
			 {
				$data = Menu::select('menu.id','menu.image','menu.nama','menu.deskripsi','menu.amount','cabang.nama_cabang','menu.stock','menu.is_active','menu.menus')
				->join('cabang','cabang.id','menu.cabang_id')
				->where('kategori','Topping')->orderBy('is_active','desc')->get();

					echo json_encode($data);

			 }
		 }
	}
}

    	// handle insert a new topping ajax request
	public function storeTopping(Request $request) {
		if($request-> file('image') != null)
		{
			$file = $request->file('image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
		}else
		{
			$fileName = '';
		}

		$menus = $request->menu;
		$menus = implode(',', $menus);

		$empData = [ 'nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Topping', 'menus' => $menus,  'cabang_id' => $request->cabang];
		Menu::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle edit an topping ajax request
	public function editTopping(Request $request) {
		$id = $request->id;
		$emp = Menu::find($id);
		return response()->json($emp);
	}

	// handle update topping ajax request
	public function updateTopping(Request $request) {
		$fileName = '';
		$emp = Menu::find($request->topping_id);
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->image) {
				Storage::delete('public/images/' . $emp->image);
			}
		} else {
			$fileName = $request->topping_image;
		}

		$menus = $request->menu;
		$menus = implode(',', $menus);

		$empData = ['nama' => $request->nama, 'deskripsi' => $request->deskripsi, 'amount' => $request->harga, 'stock' => $request->stock, 'is_active' => $request->is_active, 'image' => $fileName, 'kategori' => 'Topping', 'menus' => $menus, 'cabang_id' => $request->cabang];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

    // handle delete an topping ajax request
	public function deleteTopping(Request $request) {
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
