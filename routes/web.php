<?php

use App\Http\Controllers\CellPhoneController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/cell-phones',[CellPhoneController::class, 'index'])->name('cellphone.index');
Route::get('/cell-phone/create',[CellPhoneController::class, 'create'])->name('cellphone.create');
Route::post('/cell-phone/store',[CellPhoneController::class, 'store'])->name('cellphone.store');
Route::get('/cell-phone/edit/{id}',[CellPhoneController::class, 'edit'])->name('cellphone.edit');
Route::post('/cell-phone/update/{id}',[CellPhoneController::class, 'update'])->name('cellphone.update');
Route::get('/cell-phone/delete/{id}',[CellPhoneController::class, 'destroy'])->name('cellphone.delete');
Route::get('/search-cell-phone',[CellPhoneController::class, 'search'])->name('cellphone.search');
Route::get('/get-search-result',[CellPhoneController::class, 'searchResult'])->name('cellphone.searchResult');

