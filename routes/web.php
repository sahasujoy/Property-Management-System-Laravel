<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Route::get('/property/lands', [PropertyController::class, 'landView'])->name('land.view');

Route::post('/property/store_land', [PropertyController::class, 'storeLand'])->name('land.store');

Route::get('/property/fetch_all_lands', [PropertyController::class, 'fetchAllLands'])->name('land.fetchall');

// Route::get('/edit_engineer', [EngineerController::class, 'edit'])->name('engineer.edit');

// Route::post('/update_engineer', [EngineerController::class, 'update'])->name('engineer.update');

// Route::post('/delete_engineer', [EngineerController::class, 'delete'])->name('engineer.delete');
