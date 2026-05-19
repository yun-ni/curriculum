<?php

use Illuminate\Support\Facades\Route; //Route::get(...) の宣言

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [DisplayController::class, 'index'])->name('home');
//対象ペットの記録一覧
    Route::get('/pet/{id}/index', [DisplayController::class, 'petIndex'])->name('pet.index');
//ペット新規登録
    Route::get('/pets/pet_form', [RegistrationController::class, 'createPetForm'])->name('create.pet_form');
    Route::post('/pets/pet_form', [RegistrationController::class, 'createPet'])->name('create.pet');
    Route::get('/pets/pet_edit/{id}', [RegistrationController::class, 'editPetForm'])->name('edit.pet_form');
    Route::put('/pets/pet_edit/{id}', [RegistrationController::class, 'editPet'])->name('edit.pet');
    Route::delete('/pets/pet_edit/{id}', [RegistrationController::class, 'destroyPet'])->name('destroy.pet');
//体調記録作成
    Route::get('/healths/health_form/{id}', [RegistrationController::class, 'createHealthForm'])->name('create.health_form');
    Route::post('/healths/health_form/{id}', [RegistrationController::class, 'createHealth'])->name('create.health');
    Route::get('/healths/health_edit/{id}', [RegistrationController::class, 'editHealthForm'])->name('edit.health_form');
    Route::put('/healths/health_edit/{id}', [RegistrationController::class, 'editHealth'])->name('edit.health');
    Route::delete('/healths/health_edit/{id}', [RegistrationController::class, 'destroyHealth'])->name('destroy.health');
//通院記録作成
    Route::get('/visits/visit_form/{id}', [RegistrationController::class, 'createVisitForm'])->name('create.visit_form');
    Route::post('/visits/visit_form/{id}', [RegistrationController::class, 'createVisit'])->name('create.visit');
    Route::get('/visits/visit_edit/{id}', [RegistrationController::class, 'editVisitForm'])->name('edit.visit_form');
    Route::put('/visits/visit_edit/{id}', [RegistrationController::class, 'editVisit'])->name('edit.visit');
    Route::delete('/visits/visit_edit/{id}', [RegistrationController::class, 'destroyVisit'])->name('destroy.visit');
});
// Route::get('URLのパス', [コントローラークラス, 'メソッド名'])->name('ルート名');