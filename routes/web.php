<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])->name('home');

Route::get('/Admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/Admin/Companies', [App\Http\Controllers\AdminController::class, 'companies'])->name('adminCompanies');
Route::get('/Admin/Users', [App\Http\Controllers\AdminController::class, 'users'])->name('adminUsers');
Route::get('/Admin/Clients', [App\Http\Controllers\AdminController::class, 'clients'])->name('adminClients');
Route::get('/Admin/Operatives', [App\Http\Controllers\AdminController::class, 'operatives'])->name('adminOperatives');
Route::get('/Admin/Hospitals', [App\Http\Controllers\AdminController::class, 'hospitals'])->name('adminHospitals');

Route::post('Admin/Companies/Create', [App\Http\Controllers\CompanyController::class, 'store'])->name('storeCompany');
Route::post('Admin/Clients/Create', [App\Http\Controllers\ClientController::class, 'store'])->name('storeClient');
Route::post('Admin/Operatives/Create', [App\Http\Controllers\OperativeController::class, 'store'])->name('storeOperative');
Route::post('Admin/Hospitals/Create', [App\Http\Controllers\HospitalController::class, 'store'])->name('storeHospital');