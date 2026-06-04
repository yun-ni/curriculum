<?php

use Illuminate\Support\Facades\Route; //Route::get(...) の宣言

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VetController;

use App\Http\Controllers\OcrController;

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
    Route::get('/pet/{id}/index', [DisplayController::class, 'petIndex'])->where('id', '[0-9]+')->name('pet.index');
//ペット新規登録
    Route::get('/pets/pet_form', [RegistrationController::class, 'createPetForm'])->name('create.pet_form');
    Route::post('/pets/pet_form', [RegistrationController::class, 'createPet'])->name('create.pet');
    Route::get('/pets/pet_edit/{id}', [RegistrationController::class, 'editPetForm'])->name('edit.pet_form');
    Route::put('/pets/pet_edit/{id}', [RegistrationController::class, 'editPet'])->name('edit.pet');
    Route::delete('/pets/pet_edit/{id}', [RegistrationController::class, 'destroyPet'])->name('destroy.pet');
//体調記録作成
    Route::get('/healths/health_form/{id}', [RegistrationController::class, 'createHealthForm'])->where('id', '[0-9]+')->name('create.health_form');
    Route::post('/healths/health_form/{id}', [RegistrationController::class, 'createHealth'])->where('id', '[0-9]+')->name('create.health');
    Route::get('/healths/health_edit/{id}', [RegistrationController::class, 'editHealthForm'])->name('edit.health_form');
    Route::put('/healths/health_edit/{id}', [RegistrationController::class, 'editHealth'])->name('edit.health');
    Route::delete('/healths/health_edit/{id}', [RegistrationController::class, 'destroyHealth'])->name('destroy.health');
//通院記録作成
    Route::get('/visits/visit_form/{id}', [RegistrationController::class, 'createVisitForm'])->where('id', '[0-9]+')->name('create.visit_form');
    Route::post('/visits/visit_form/{id}', [RegistrationController::class, 'createVisit'])->where('id', '[0-9]+')->name('create.visit');
    Route::get('/visits/visit_edit/{id}', [RegistrationController::class, 'editVisitForm'])->name('edit.visit_form');
    Route::put('/visits/visit_edit/{id}', [RegistrationController::class, 'editVisit'])->name('edit.visit');
    Route::delete('/visits/visit_edit/{id}', [RegistrationController::class, 'destroyVisit'])->name('destroy.visit');
// OCR読み込み用
    // OCR画面表示
    Route::post('/visit/ocr/{petId}', [OcrController::class, 'visitOcr'])->name('visit.ocr');
    // OCR実行
    Route::post('/visit/ocr/generate/{petId}', [OcrController::class, 'generate'])->name('visit.ocr.generate');
});
// Route::get('URLのパス', [コントローラークラス, 'メソッド名'])->name('ルート名');

// 獣医師画面
Route::middleware(['auth:vets'])->prefix('vet')->group(function () {
    Route::get('/dashboard', [VetController::class, 'dashboard'])->name('vet.dashboard');
    Route::get('/search', [VetController::class, 'search'])->name('vet.search');
    Route::get('/show/{id}', [VetController::class, 'show'])->name('vet.show');
    Route::get('/index/{id}', [VetController::class, 'index'])->name('vet.index');
    Route::get('/pdf/{id}', [VetController::class, 'pdf'])->name('vet.pdf');
});

// 管理者画面
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/index/{id}', [AdminController::class, 'index'])->name('admin.index');
});