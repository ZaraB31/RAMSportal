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
Route::get('/Project/Create/Details', [App\Http\Controllers\ProjectController::class, 'createDetails'])->name('createProjectDetails');
Route::post('/Project/Create/Details', [App\Http\Controllers\ProjectController::class, 'storeDetails'])->name('storeProjectDetails');
Route::get('/Project/Create/Method/{id}', [App\Http\Controllers\ProjectController::class, 'createMethod'])->name('createProjectMethod');
Route::post('/Project/Create/Method', [App\Http\Controllers\ProjectController::class, 'storeMethod'])->name('storeProjectMethod');
Route::get('/Project/Create/Risks/{id}', [App\Http\Controllers\ProjectController::class, 'createRisks'])->name('createProjectRisks');
Route::post('/Project/Create/Risks', [App\Http\Controllers\ProjectController::class, 'storeRisks'])->name('storeProjectRisks');
Route::get('/Project/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('showProject');
Route::get('/generate-RAMS/{id}', [App\Http\Controllers\PDFController::class, 'generateRAMS']);
Route::get('/generate-dailyRA/{id}', [App\Http\Controllers\PDFController::class, 'generateDailyRA']);

Route::get('/Admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/Admin/Companies', [App\Http\Controllers\AdminController::class, 'companies'])->name('adminCompanies');
Route::get('/Admin/Users', [App\Http\Controllers\AdminController::class, 'users'])->name('adminUsers');
Route::get('/Admin/Clients', [App\Http\Controllers\AdminController::class, 'clients'])->name('adminClients');
Route::get('/Admin/Operatives', [App\Http\Controllers\AdminController::class, 'operatives'])->name('adminOperatives');
Route::get('/Admin/Hospitals', [App\Http\Controllers\AdminController::class, 'hospitals'])->name('adminHospitals');
Route::get('/Admin/PPE', [App\Http\Controllers\AdminController::class, 'PPEs'])->name('adminPPE');
Route::get('/Admin/Sections', [App\Http\Controllers\AdminController::class, 'sections'])->name('adminSections');
Route::get('/Admin/Tools', [App\Http\Controllers\AdminController::class, 'tools'])->name('adminTools');
Route::get('/Admin/People', [App\Http\Controllers\AdminController::class, 'people'])->name('adminPeople');
Route::get('/Admin/Risks', [App\Http\Controllers\AdminController::class, 'risks'])->name('adminRisks');

Route::post('Admin/Companies/Create', [App\Http\Controllers\CompanyController::class, 'store'])->name('storeCompany');
Route::post('Admin/Clients/Create', [App\Http\Controllers\ClientController::class, 'store'])->name('storeClient');
Route::post('Admin/Operatives/Create', [App\Http\Controllers\OperativeController::class, 'store'])->name('storeOperative');
Route::post('Admin/Hospitals/Create', [App\Http\Controllers\HospitalController::class, 'store'])->name('storeHospital');
Route::post('Admin/PPE/Create', [App\Http\Controllers\PpeController::class, 'store'])->name('storePPE');
Route::post('Admin/Sections/Create', [App\Http\Controllers\SectionController::class, 'store'])->name('storeSection');
Route::post('Admin/Tools/Create', [App\Http\Controllers\ToolController::class, 'store'])->name('storeTool');
Route::post('Admin/People/Create', [App\Http\Controllers\PersonController::class, 'store'])->name('storePerson');
Route::get('Admin/Risks/Create', [App\Http\Controllers\RiskController::class, 'create'])->name('createRisk');
Route::post('Admin/Risks/Create', [App\Http\Controllers\RiskController::class, 'store'])->name('storeRisk');
