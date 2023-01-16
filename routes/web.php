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

    Route::get('menu', [AdminController::class, 'index'])->name('menu');
    Route::get('list-menu', [AdminController::class, 'getMenu'])->name('list-menu');

    Route::get('dashboard-menu', [AdminController::class, 'dashboard_menu'])->name('dashboard-menu');

    Route::get('menu-minuman', [AdminController::class, 'index_minuman'])->name('minuman');
    Route::get('list-minuman', [AdminController::class, 'getMinuman'])->name('list-minuman');

    Route::get('menu-topping', [AdminController::class, 'index_topping'])->name('topping');
    Route::get('list-topping', [AdminController::class, 'getTopping'])->name('list-topping');
    Route::get('laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('absensi', [AdminController::class, 'absensi'])->name('absensi');

    Route::get('laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('absensi', [AdminController::class, 'absensi'])->name('absensi');

});

