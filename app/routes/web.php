<?php

use Illuminate\Support\Facades\Route; //Route::get(...) の宣言

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
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

//Auth::routes();

//Route::group(['middleware' => 'auth'], function() {});
Route::get('/', [DisplayController::class, 'index']);
//対象ペットの記録一覧
Route::get('/pet/{id}/index', [DisplayController::class, 'petIndex'])->name('pet.index');
//ペット新規登録
Route::get('/pets/pet_form', [RegistrationController::class, 'createPetForm'])->name('create.pet_form');
Route::post('/pets/pet_form', [RegistrationController::class, 'createPet'])->name('create.pet');
//体調記録作成
Route::get('/healths/health_form', [RegistrationController::class, 'createHealthForm'])->name('create.health_form');
Route::post('/healths/health_form', [RegistrationController::class, 'createHealth'])->name('create.health');
//通院記録作成
Route::get('/visits/visit_form', [RegistrationController::class, 'createVisitForm'])->name('create.visit_form');
Route::post('/visits/visit_form', [RegistrationController::class, 'createVisit'])->name('create.visit');

// Route::get('URLのパス', [コントローラークラス, 'メソッド名'])->name('ルート名');