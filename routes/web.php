<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\AdminMakananController;
use App\Http\Controllers\AdminMinumanController;
use App\Http\Controllers\AdminToppingController;
use App\Http\Controllers\AdminAkunController;
use App\Http\Controllers\AdminAbsenController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminCabangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

/*------------------------------------------
--------------------------------------------
All Kasir Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:1'])->group(function () { //kasir
    Route::get('order', [KasirController::class, 'order'])->name('order');
    Route::get('order/{makanan}/{id}/{harga}', [KasirController::class, 'topping'])->name('order-topping');
    Route::post('order/place_order', [KasirController::class,'place_order'])->name('place-order');
    Route::post('order/place_order_minuman', [KasirController::class,'place_order_minuman'])->name('place-order-minuman');
    Route::post('order/place_order_minuman_add', [KasirController::class,'place_order_minuman_add'])->name('place-order-minuman-add');
    Route::post('order/delete_order', [KasirController::class,'delete_order'])->name('delete-order');
    Route::get('order/preview-order', [KasirController::class,'preview_order'])->name('preview-order');
    Route::post('order/submit-order', [KasirController::class, 'submit_order'])->name('submit-order');

    Route::get('order/list-order', [KasirController::class,'list_order'])->name('list-order');

    Route::get('order/payment-order/{id}', [KasirController::class,'payment_order'])->name('payment-order');
    Route::post('order/complete-order', [KasirController::class,'complete_order'])->name('complete-order');
    Route::get('order/add-order/{id}', [KasirController::class,'add_order'])->name('add-order');
    Route::get('order/add-order/{id}/{makanan}/{harga}/{id_makanan}', [KasirController::class,'add_order_topping'])->name('add-topping');
    
    Route::post('order/delete-order-add', [KasirController::class,'delete_order_add'])->name('delete-order-add');
    Route::post('order/submit-order-add', [KasirController::class, 'submit_order_add'])->name('submit-order-add');

    Route::post('order/print-order', [KasirController::class, 'print_order'])->name('print_order');

    // ABSENSI KASIR
    Route::get('/absen-kasir', [KasirController::class, 'indexAbsenKasir'])->name('absen-kasir');
    Route::get('/fetchAllAbsenKasir', [KasirController::class, 'fetchAllAbsenKasir'])->name('fetchAllAbsenKasir');
    Route::post('/fetchAllAbsenKasirx', [KasirController::class, 'fetchAllAbsenKasirx'])->name('fetchAllAbsenKasirx');

    Route::post('/checkinKasir', [KasirController::class, 'checkinKasir'])->name('checkinKasir');
    Route::post('/checkoutKasir', [KasirController::class, 'checkoutKasir'])->name('checkoutKasir');

});

/*------------------------------------------
--------------------------------------------
All Dapur Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:2'])->group(function () { //dapur
    Route::get('dapur', [DapurController::class, 'index'])->name('dapur');
    Route::get('dapur/detail/{id}', [DapurController::class, 'detail'])->name('dapur-detail');
    Route::post('dapur/update-order', [DapurController::class, 'update_flag_order'])->name('update-flag-order');
    Route::post('dapur/update-pesanan', [DapurController::class, 'update_flag_order_detail'])->name('update-flag-detail');

     // ABSENSI DAPUR
     Route::get('/absen-dapur', [DapurController::class, 'indexAbsenDapur'])->name('absen-dapur');
     Route::get('/fetchAllAbsenDapur', [DapurController::class, 'fetchAllAbsenDapur'])->name('fetchAllAbsenDapur');
     Route::post('/fetchAllAbsenDapurx', [DapurController::class, 'fetchAllAbsenDapurx'])->name('fetchAllAbsenDapurx');

     Route::post('/checkinDapur', [DapurController::class, 'checkinDapur'])->name('checkinDapur');
     Route::post('/checkoutDapur', [DapurController::class, 'checkoutDapur'])->name('checkoutDapur');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:3'])->group(function () {//admin

    // Route::get('menu', [AdminController::class, 'index'])->name('menu');
    // Route::get('list-menu', [AdminController::class, 'getMenu'])->name('list-menu');

    // Route::get('menu-minuman', [AdminController::class, 'index_minuman'])->name('minuman');
    // Route::get('list-minuman', [AdminController::class, 'getMinuman'])->name('list-minuman');

    // Route::get('menu-topping', [AdminController::class, 'index_topping'])->name('topping');
    // Route::get('list-topping', [AdminController::class, 'getTopping'])->name('list-topping');
    Route::get('laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('absensi', [AdminController::class, 'absensi'])->name('absensi');

    Route::get('laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('absensi', [AdminController::class, 'absensi'])->name('absensi');


    /*
        MENU MAKANAN
    */
    Route::get('/makanan', [AdminMakananController::class, 'index'])->name('makanan');
    Route::get('/fetchall', [AdminMakananController::class, 'fetchAll'])->name('fetchAll');
    Route::post('/store', [AdminMakananController::class, 'store'])->name('store');
    Route::get('/edit', [AdminMakananController::class, 'edit'])->name('edit');
    Route::post('/update', [AdminMakananController::class, 'update'])->name('update');
    Route::delete('/delete', [AdminMakananController::class, 'delete'])->name('delete');
    Route::post('/fetchAllMakananx', [AdminMakananController::class, 'fetchAllMakananx'])->name('fetchAllMakananx');

    /*
        MENU MINUMAN
    */
    Route::get('/minuman', [AdminMinumanController::class, 'indexMinuman'])->name('minuman');
    Route::get('/fetchallMinuman', [AdminMinumanController::class, 'fetchAllMinuman'])->name('fetchAllMinuman');
    Route::post('/storeMinuman', [AdminMinumanController::class, 'storeMinuman'])->name('storeMinuman');
    Route::get('/editMinuman', [AdminMinumanController::class, 'editMinuman'])->name('editMinuman');
    Route::post('/updateMinuman', [AdminMinumanController::class, 'updateMinuman'])->name('updateMinuman');
    Route::delete('/deleteMinuman', [AdminMinumanController::class, 'deleteMinuman'])->name('deleteMinuman');
    Route::post('/fetchAllMinumanx', [AdminMinumanController::class, 'fetchAllMinumanx'])->name('fetchAllMinumanx');


     /*
        MENU TOPPING
    */
    Route::get('/topping', [AdminToppingController::class, 'indexTopping'])->name('topping');
    Route::get('/fetchallTopping', [AdminToppingController::class, 'fetchAllTopping'])->name('fetchAllTopping');
    Route::post('/storeTopping', [AdminToppingController::class, 'storeTopping'])->name('storeTopping');
    Route::get('/editTopping', [AdminToppingController::class, 'editTopping'])->name('editTopping');
    Route::post('/updateTopping', [AdminToppingController::class, 'updateTopping'])->name('updateTopping');
    Route::delete('/deleteTopping', [AdminToppingController::class, 'deleteTopping'])->name('deleteTopping');
    Route::post('/fetchAllToppingx', [AdminToppingController::class, 'fetchAllToppingx'])->name('fetchAllToppingx');


    /*
        MANAGE AKUN
    */

    Route::get('/account', [AdminAkunController::class, 'indexAkun'])->name('akun');
    Route::get('/fetchAllAkun', [AdminAkunController::class, 'fetchAllAkun'])->name('fetchAllAkun');
    Route::post('/storeAkun', [AdminAkunController::class, 'storeAkun'])->name('storeAkun');
    Route::get('/editAkun', [AdminAkunController::class, 'editAkun'])->name('editAkun');
    Route::post('/updateAkun', [AdminAkunController::class, 'updateAkun'])->name('updateAkun');
    Route::delete('/deleteAkun', [AdminAkunController::class, 'deleteAkun'])->name('deleteAkun');
    Route::post('/fetchAllAkunx', [AdminAkunController::class, 'fetchAllAkunx'])->name('fetchAllAkunx');


     /*
        MANAGE Absensi
    */

    Route::get('/absen', [AdminAbsenController::class, 'indexAbsen'])->name('absen');
    Route::get('/fetchAllAbsen', [AdminAbsenController::class, 'fetchAllAbsen'])->name('fetchAllAbsen');
    Route::post('/fetchAllAbsenx', [AdminAbsenController::class, 'fetchAllAbsenx'])->name('fetchAllAbsenx');

       /*
        MANAGE LAPORAN
    */

    Route::get('/laporan', [AdminLaporanController::class, 'indexLaporan'])->name('laporan');
    Route::get('/fetchAllOrder', [AdminLaporanController::class, 'fetchAllOrder'])->name('fetchAllOrder');
    Route::post('/fetchAllOrderx', [AdminLaporanController::class, 'fetchAllOrderx'])->name('fetchAllOrderx');

      /*
        MENU CABANG
    */
    Route::get('/cabang', [AdminCabangController::class, 'indexCabang'])->name('cabang');
    Route::get('/fetchallCabang', [AdminCabangController::class, 'fetchAllCabang'])->name('fetchAllCabang');
    Route::post('/storeCabang', [AdminCabangController::class, 'storeCabang'])->name('storeCabang');
    Route::get('/editCabang', [AdminCabangController::class, 'editCabang'])->name('editCabang');
    Route::post('/updateCabang', [AdminCabangController::class, 'updateCabang'])->name('updateCabang');
    Route::delete('/deleteCabang', [AdminCabangController::class, 'deleteCabang'])->name('deleteCabang');
});

