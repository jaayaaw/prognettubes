<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\MasterIksController;
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
Route::get('/',function(){
    return redirect('/masteriks');
});
// Route::get('/crud',[CrudController::class,'index'])->name('crud.list');
// Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
// Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
// Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');

// Route::post('/crud',[CrudController::class,'store'])->name('crud.store');

// Route::put('/crud/{id}',[CrudController::class,'update'])->name('crud.update');

// Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');

Route::get('/masteriks',[MasterIksController::class,'index'])->name('iks.list');
Route::get('/masteriks/create',[MasterIksController::class,'create'])->name('iks.create');
Route::get('/masteriks/{id}/edit',[MasterIksController::class,'edit'])->name('iks.edit');
Route::delete('/masteriks/{id}',[MasterIksController::class,'deleteData'])->name('iks.delete');

Route::post('/masteriks',[MasterIksController::class,'store'])->name('iks.store');

Route::put('/masteriks/{id}',[MasterIksController::class,'update'])->name('iks.update');

Route::post('/masteriks/listData',[MasterIksController::class,'listData'])->name('iks.listData');