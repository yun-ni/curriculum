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

Route::get('/', [DisplayController::class, 'index']);
Route::get('/pet/{id}/index', [DisplayController::class, 'petIndex'])->name('pet.index');
Route::get('/create_pet', [RegistrationController::class, 'createPetForm'])->name('create.pet');
Route::post('pets/create', [RegistrationController::class, 'createPet']);
// Route::get('URLのパス', [コントローラークラス, 'メソッド名'])->name('ルート名');