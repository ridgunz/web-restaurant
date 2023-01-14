<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function order(){
        return view('kasir.order');
    }

    public function topping(Request $request){
        // dd($request);
        return view('kasir.topping', ['id' => $request->id, 'nama_makanan' => $request->makanan]);
    }
}
