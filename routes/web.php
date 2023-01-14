<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;

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
    return view('welcome');
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
    Route::get('order/{makanan}/{id}', [KasirController::class, 'topping'])->name('order-topping');

});

/*------------------------------------------
--------------------------------------------
All Dapur Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:2'])->group(function () { //dapur
  

});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:3'])->group(function () {//admin

    Route::get('list-menu', [AdminController::class, 'list'])->name('list-menu');
    // Route::get('tambah', [AdminController::class, 'tambah'])->name('tambah');
    Route::get('laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('absensi', [AdminController::class, 'absensi'])->name('absensi');

});

