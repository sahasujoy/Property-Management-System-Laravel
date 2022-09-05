<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DueController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegistrationController;
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

// -------------------------------------- Land CRUD -----------------------------------------
Route::get('/property/lands', [PropertyController::class, 'landView'])->name('land.view');

Route::post('/property/store_land', [PropertyController::class, 'storeLand'])->name('land.store');

Route::get('/property/fetch_all_lands', [PropertyController::class, 'fetchAllLands'])->name('land.fetchall');

// Route::get('/edit_engineer', [EngineerController::class, 'edit'])->name('engineer.edit');

// Route::post('/update_engineer', [EngineerController::class, 'update'])->name('engineer.update');

// Route::post('/delete_engineer', [EngineerController::class, 'delete'])->name('engineer.delete');



// -------------------------------------- Building CRUD -----------------------------------------
Route::get('/property/buildings', [PropertyController::class, 'buildingView'])->name('building.view');

Route::post('/property/store_building', [PropertyController::class, 'storeBuilding'])->name('building.store');

Route::get('/property/fetch_all_buildings', [PropertyController::class, 'fetchAllBuildings'])->name('building.fetchall');

Route::get('/property/edit_building', [PropertyController::class, 'editBuilding'])->name('building.edit');

Route::post('/property/update_building', [PropertyController::class, 'updateBuilding'])->name('building.update');

Route::post('/property/delete_building', [PropertyController::class, 'deleteBuilding'])->name('building.delete');


// -------------------------------------- Flat CRUD -----------------------------------------
Route::get('/property/flats', [PropertyController::class, 'flatView'])->name('flat.view');

Route::post('/property/store_flat', [PropertyController::class, 'storeFlat'])->name('flat.store');

Route::get('/property/fetch_all_flats', [PropertyController::class, 'fetchAllFlats'])->name('flat.fetchall');

// -------------------------------------- Customer CRUD -----------------------------------------
Route::get('/customers', [CustomerController::class, 'customerView'])->name('customer.view');

Route::post('/store_customer', [CustomerController::class, 'storeCustomer'])->name('customer.store');

Route::get('/fetch_all_customers', [CustomerController::class, 'fetchAllCustomers'])->name('customer.fetchall');

// -------------------------------------- Registration CRUD -----------------------------------------
Route::get('/registrations', [RegistrationController::class, 'registrationView'])->name('registration.view');

Route::post('/store_registration', [RegistrationController::class, 'storeRegistration'])->name('registration.store');

Route::get('/fetch_all_registrations', [RegistrationController::class, 'fetchAllRegistrations'])->name('registration.fetchall');

Route::get('/registration_details/{id}', [RegistrationController::class, 'registrationDetails'])->name('registration.details');

// ----------------------------------------------------- Status CRUD -----------------------------------------
Route::get('/statuses', [RegistrationController::class, 'statusView'])->name('registration.status.view');

Route::post('/store_status', [RegistrationController::class, 'storeStatus'])->name('registration.status.store');

Route::get('/fetch_all_statuses', [RegistrationController::class, 'fetchAllStatuses'])->name('registration.status.fetchall');

// ------------------------------------------------------- Price CRUD -------------------------------------------------------------
Route::get('/regprices', [PriceController::class, 'regPriceView'])->name('price.reg.view');

Route::get('/flatprices', [PriceController::class, 'flatPriceView'])->name('price.flat.view');

Route::post('/store_price', [PriceController::class, 'storePrice'])->name('price.store');

Route::get('/fetch_all_regprices', [PriceController::class, 'fetchAllRegPrices'])->name('price.reg.fetchall');

Route::get('/fetch_all_flatprices', [PriceController::class, 'fetchAllFlatPrices'])->name('price.reg.fetchall');

// -------------------------------------- Payment CRUD -----------------------------------------------------------------
Route::get('/regpayments', [PaymentController::class, 'regPaymentView'])->name('payment.reg.view');

Route::get('/flatpayments', [PaymentController::class, 'flatPaymentView'])->name('payment.flat.view');

Route::post('/store_payment', [PaymentController::class, 'storePayment'])->name('payment.store');

Route::get('/fetch_all_regpayments', [PaymentController::class, 'fetchAllRegPayments'])->name('payment.reg.fetchall');

Route::get('/fetch_all_flatpayments', [PaymentController::class, 'fetchAllFlatPayments'])->name('payment.reg.fetchall');

//------------------------------------------------------- DUES ----------------------------------------------------------
Route::get('/regdues', [DueController::class, 'regDueView'])->name('due.reg.view');

Route::get('/flatdues', [DueController::class, 'flatDueView'])->name('due.flat.view');

Route::get('/fetch_all_regdues', [DueController::class, 'fetchAllRegDues'])->name('due.reg.fetchall');

Route::get('/fetch_all_flatdues', [DueController::class, 'fetchAllFlatDues'])->name('payment.reg.fetchall');

//--------------------------------------------- Building & Flat (bnf) Details -----------------------------------------------------
Route::get('/property/bnf_details', [PropertyController::class, 'bnfDetails'])->name('bnf.view');

Route::get('/property/fbyb/{id}', [PropertyController::class, 'fbyb'])->name('bnf.fbyb');

Route::post('/property/bnf_filter', [PropertyController::class, 'bnfFilter'])->name('bnf.filter');

