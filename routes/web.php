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
Route::get('/Search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/SearchTitle', [App\Http\Controllers\SearchController::class, 'searchTitle'])->name('searchTitle');
Route::post('/SearchClient', [App\Http\Controllers\SearchController::class, 'searchClient'])->name('searchClient');
Route::post('/SearchCompany', [App\Http\Controllers\SearchController::class, 'searchCompany'])->name('searchCompany');
Route::get('/Project/Create/Details', [App\Http\Controllers\ProjectController::class, 'createDetails'])->name('createProjectDetails');
Route::post('/Project/Create/Details', [App\Http\Controllers\ProjectController::class, 'storeDetails'])->name('storeProjectDetails');
Route::get('/Project/Create/Method/{id}', [App\Http\Controllers\ProjectController::class, 'createMethod'])->name('createProjectMethod');
Route::post('/Project/Create/Method/{id}', [App\Http\Controllers\ProjectController::class, 'storeMethod'])->name('storeProjectMethod');
Route::get('/Project/Create/Risks/{id}', [App\Http\Controllers\ProjectController::class, 'createRisks'])->name('createProjectRisks');
Route::post('/Project/Create/Risks/{id}', [App\Http\Controllers\ProjectController::class, 'storeRisks'])->name('storeProjectRisks');
Route::get('/Project/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('showProject');
Route::get('/Project/{id}/Edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('editProject');
Route::post('/Project/{id}/Update', [App\Http\Controllers\ProjectController::class, 'update'])->name('updateProject');
Route::post('/Project/{id}/Approve', [App\Http\Controllers\ApprovalController::class, 'approve'])->name('approveProject');
Route::get('/Project/{id}/download/{version}', [App\Http\Controllers\ProjectController::class, 'download'])->name('downloadProject');
Route::delete('/DeleteProject/{id}', [App\Http\Controllers\ProjectController::class, 'delete'])->name('deleteProject');
route::get('/select2-autocomplete-ajax', [App\Http\Controllers\ProjectController::class, 'dataAjax']);

Route::get('/generate-RAMS/{id}', [App\Http\Controllers\PDFController::class, 'download']);

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
Route::get('/Admin/RiskTypes', [App\Http\Controllers\AdminController::class, 'riskTypes'])->name('adminRiskTypes');
Route::get('/Admin/Risks', [App\Http\Controllers\AdminController::class, 'risks'])->name('adminRisks');
Route::get('/Admin/Qualifications', [App\Http\Controllers\AdminController::class, 'qualifications'])->name('adminQualifications');

Route::post('Admin/Companies/Create', [App\Http\Controllers\CompanyController::class, 'store'])->name('storeCompany');
Route::post('Admin/Clients/Create', [App\Http\Controllers\ClientController::class, 'store'])->name('storeClient');
Route::post('Admin/Operatives/Create', [App\Http\Controllers\OperativeController::class, 'store'])->name('storeOperative');
Route::get('Admin/Operatives/Edit/{id}', [App\Http\Controllers\OperativeController::class, 'edit'])->name('editOperative');
Route::post('Admin/Operatives/Edit/{id}', [App\Http\Controllers\OperativeController::class, 'update'])->name('updateOperative');
Route::post('Admin/Hospitals/Create', [App\Http\Controllers\HospitalController::class, 'store'])->name('storeHospital');
Route::post('Admin/PPE/Create', [App\Http\Controllers\PpeController::class, 'store'])->name('storePPE');
Route::post('Admin/Sections/Create', [App\Http\Controllers\SectionController::class, 'store'])->name('storeSection');
Route::post('Admin/Tools/Create', [App\Http\Controllers\ToolController::class, 'store'])->name('storeTool');
Route::post('Admin/People/Create', [App\Http\Controllers\PersonController::class, 'store'])->name('storePerson');
Route::get('Admin/Risks/Create', [App\Http\Controllers\RiskController::class, 'create'])->name('createRisk');
Route::post('Admin/Risks/Create', [App\Http\Controllers\RiskController::class, 'store'])->name('storeRisk');
Route::get('Admin/Risks/Edit/{id}', [App\Http\Controllers\RiskController::class, 'edit'])->name('EditRisk');
Route::post('Admin/Risks/Edit/{id}', [App\Http\Controllers\RiskController::class, 'update'])->name('updateRisk');
Route::post('Admin/RiskTypes/Create', [App\Http\Controllers\RiskTypeController::class, 'store'])->name('storeRiskType');
Route::post('Admin/Qualifications/Create', [App\Http\Controllers\QualificationController::class, 'store'])->name('storeQualification');

Route::post('Admin/EditClient/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('updateClient');
Route::post('Admin/EditHospital/{id}', [App\Http\Controllers\HospitalController::class, 'update'])->name('updateHospital');
Route::post('Admin/EditPPE/{id}', [App\Http\Controllers\PPEController::class, 'update'])->name('updatePpe');
Route::post('Admin/EditSection/{id}', [App\Http\Controllers\SectionController::class, 'update'])->name('updateSection');
Route::post('Admin/EditTool/{id}', [App\Http\Controllers\ToolController::class, 'update'])->name('updateTool');
Route::post('Admin/EditPeople/{id}', [App\Http\Controllers\PersonController::class, 'update'])->name('updatePerson');
Route::post('Admin/EditRiskType/{id}', [App\Http\Controllers\RiskTypeController::class, 'update'])->name('updateRiskType');
Route::post('Admin/EditQualification/{id}', [App\Http\Controllers\QualificationController::class, 'update'])->name('updateQualification');

Route::delete('/DeleteClient/{id}', [App\Http\Controllers\ClientController::class, 'delete'])->name('deleteClient');
Route::delete('/DeleteCompany/{id}', [App\Http\Controllers\CompanyController::class, 'delete'])->name('deleteCompany');
Route::delete('/DeleteHospital/{id}', [App\Http\Controllers\HospitalController::class, 'delete'])->name('deleteHospital');
Route::delete('/DeleteOperative/{id}', [App\Http\Controllers\OperativeController::class, 'delete'])->name('deleteOperative');
Route::delete('/DeletePerson/{id}', [App\Http\Controllers\PersonController::class, 'delete'])->name('deletePerson');
Route::delete('/DeletePPE/{id}', [App\Http\Controllers\PpeController::class, 'delete'])->name('deletePPE');
Route::delete('/DeleteQualification/{id}', [App\Http\Controllers\QualificationController::class, 'delete'])->name('deleteQualification');
Route::delete('/DeleteRisk/{id}', [App\Http\Controllers\RiskController::class, 'delete'])->name('deleteRisk');
Route::delete('/DeleteRiskType/{id}', [App\Http\Controllers\RiskTypeController::class, 'delete'])->name('deleteRiskType');
Route::delete('/DeleteSection/{id}', [App\Http\Controllers\SectionController::class, 'delete'])->name('deleteSection');
Route::delete('/DeleteSection/{id}', [App\Http\Controllers\SectionController::class, 'delete'])->name('deleteSection');