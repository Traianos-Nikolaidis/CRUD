<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
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

Route::get('/',  [PersonController::class, 'index']);
Route::resource('person', PersonController::class)->names(['create' => 'person.build']);

// //Route::prefix('https://8000-gitpodsampl-templatephp-qek5uyjagci.ws-eu97.gitpod.io')->group(function (){
//     Route::get('/person/{person}',[PersonController::class, 'show'])->name('person.show');
//     Route::get('/person',[PersonController::class, 'index'])->name('person.index');
//     Route::get('/person/create',[PersonController::class, 'create'])->name('person.create');
//     Route::post('/person',[PersonController::class, 'store'])->name('person.store');
//     Route::get('/person/{person}/edit',[PersonController::class, 'edit'])->name('person.edit');
//     Route::put('/person/{person} ',[PersonController::class, 'update'])->name('person.update');
//     Route::delete('/person/{person} ',[PersonController::class, 'delete'])->name('person.delete');
// //});
