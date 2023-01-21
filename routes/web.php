<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\MasterIksController;
use App\Http\Controllers\TransaksiProviderIksController;
use App\Http\Controllers\TransaksiKomponenIksController;
use App\Http\Controllers\MasterPenjaminController;
use App\Http\Controllers\MasterIksGroupKomponenController;
use App\Http\Controllers\MasterIksGroupKomponenDetailController;
use App\Http\Controllers\MasterIksTipeController;
use App\Http\Controllers\TransaksiKomponenIksDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
    return redirect('/login');
});

Route::get('/login',[LoginController::class,'index'])->name('login.index');
Route::post('/login',[LoginController::class,'authenticate'])->name('login.authenticate');
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/register',[RegisterController::class,'index'])->name('register.index');
Route::post('/register',[RegisterController::class,'store'])->name('register.store');

// Route::get('/crud',[CrudController::class,'index'])->name('crud.list');
// Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
// Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
// Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');

// Route::post('/crud',[CrudController::class,'store'])->name('crud.store');

// Route::put('/crud/{id}',[CrudController::class,'update'])->name('crud.update');

// Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');

// Master Iks //
Route::get('/masteriks',[MasterIksController::class,'index'])->name('iks.list');
Route::get('/masteriks/create',[MasterIksController::class,'create'])->name('iks.create');
Route::get('/masteriks/{id}/edit',[MasterIksController::class,'edit'])->name('iks.edit');
Route::delete('/masteriks/{id}',[MasterIksController::class,'deleteData'])->name('iks.delete');

Route::post('/masteriks',[MasterIksController::class,'store'])->name('iks.store');

Route::put('/masteriks/{id}',[MasterIksController::class,'update'])->name('iks.update');

Route::post('/masteriks/listData',[MasterIksController::class,'listData'])->name('iks.listData');


// Transaksi Provider //
Route::get('/provideriks/{id}/{name}',[TransaksiProviderIksController::class,'index'])->name('provideriks.list');
Route::get('/provideriks/{id}/{name}/create',[TransaksiProviderIksController::class,'create'])->name('provideriks.create');
Route::get('/provideriks/{id}/{name}/edit',[TransaksiProviderIksController::class,'edit'])->name('provideriks.edit');
Route::delete('/provideriks/{id}',[TransaksiProviderIksController::class,'deleteData'])->name('provideriks.delete');

Route::post('/provideriks/@/{name}',[TransaksiProviderIksController::class,'store'])->name('provideriks.store');

Route::put('/provideriks/!/{id}/{name}',[TransaksiProviderIksController::class,'update'])->name('provideriks.update');

Route::post('/provideriks/listData',[TransaksiProviderIksController::class,'listData'])->name('provideriks.listData');


// Transaksi Komponen //
Route::get('/tkomponeniks/{id}/{name}',[TransaksiKomponenIksController::class,'index'])->name('tkomponeniks.list');
Route::get('/tkomponeniks/{id}/{name}/create',[TransaksiKomponenIksController::class,'create'])->name('tkomponeniks.create');
Route::get('/tkomponeniks/{id}/{name}/edit',[TransaksiKomponenIksController::class,'edit'])->name('tkomponeniks.edit');
Route::delete('/tkomponeniks/{id}',[TransaksiKomponenIksController::class,'deleteData'])->name('tkomponeniks.delete');

Route::post('/tkomponeniks/@/{name}',[TransaksiKomponenIksController::class,'store'])->name('tkomponeniks.store');

Route::put('/tkomponeniks/!/{id}/{name}',[TransaksiKomponenIksController::class,'update'])->name('tkomponeniks.update');

Route::post('/tkomponeniks/listData',[TransaksiKomponenIksController::class,'listData'])->name('tkomponeniks.listData');


// Master Penjamin //
Route::get('/penjamin',[MasterPenjaminController::class,'index'])->name('penjamin.list');
Route::get('/penjamin/create',[MasterPenjaminController::class,'create'])->name('penjamin.create');
Route::get('/penjamin/{id}/edit',[MasterPenjaminController::class,'edit'])->name('penjamin.edit');
Route::delete('/penjamin/{id}',[MasterPenjaminController::class,'deleteData'])->name('penjamin.delete');

Route::post('/penjamin',[MasterPenjaminController::class,'store'])->name('penjamin.store');

Route::put('/penjamin/{id}',[MasterPenjaminController::class,'update'])->name('penjamin.update');

Route::post('/penjamin/listData',[MasterPenjaminController::class,'listData'])->name('penjamin.listData');


// Master Group Komponen //
Route::get('/gkomponen',[MasterIksGroupKomponenController::class,'index'])->name('gkomponen.list');
Route::get('/gkomponen/create',[MasterIksGroupKomponenController::class,'create'])->name('gkomponen.create');
Route::get('/gkomponen/{id}/edit',[MasterIksGroupKomponenController::class,'edit'])->name('gkomponen.edit');
Route::delete('/gkomponen/{id}',[MasterIksGroupKomponenController::class,'deleteData'])->name('gkomponen.delete');

Route::post('/gkomponen',[MasterIksGroupKomponenController::class,'store'])->name('gkomponen.store');

Route::put('/gkomponen/{id}',[MasterIksGroupKomponenController::class,'update'])->name('gkomponen.update');

Route::post('/gkomponen/listData',[MasterIksGroupKomponenController::class,'listData'])->name('gkomponen.listData');


// Master Group Komponen Detail //
Route::get('/iksgkdetail/{id}',[MasterIksGroupKomponenDetailController::class,'index'])->name('iksgkdetail.list');
Route::get('/iksgkdetail/{id}/create',[MasterIksGroupKomponenDetailController::class,'create'])->name('iksgkdetail.create');
Route::get('/iksgkdetail/{id}/edit',[MasterIksGroupKomponenDetailController::class,'edit'])->name('iksgkdetail.edit');
Route::delete('/iksgkdetail/{id}',[MasterIksGroupKomponenDetailController::class,'deleteData'])->name('iksgkdetail.delete');
Route::post('/iksgkdetail',[MasterIksGroupKomponenDetailController::class,'store'])->name('iksgkdetail.store');
Route::put('/iksgkdetail/{id}',[MasterIksGroupKomponenDetailController::class,'update'])->name('iksgkdetail.update');
Route::post('/iksgkdetail/listData',[MasterIksGroupKomponenDetailController::class,'listData'])->name('iksgkdetail.listData');


// Master IKS Tipe //
Route::get('/ikstipe',[MasterIksTipeController::class,'index'])->name('masterikstipe.list');
Route::get('/ikstipe/create',[MasterIksTipeController::class,'create'])->name('masterikstipe.create');
Route::get('/ikstipe/{id}/edit',[MasterIksTipeController::class,'edit'])->name('masterikstipe.edit');
Route::delete('/ikstipe/{id}',[MasterIksTipeController::class,'deleteData'])->name('masterikstipe.delete');

Route::post('/ikstipe',[MasterIksTipeController::class,'store'])->name('masterikstipe.store');

Route::put('/ikstipe/{id}',[MasterIksTipeController::class,'update'])->name('masterikstipe.update');

Route::post('/ikstipe/listData',[MasterIksTipeController::class,'listData'])->name('masterikstipe.listData');


// Transaksi Komponen IKS Detail //
Route::get('/komponeniksdetail/{id}/{name}',[TransaksiKomponenIksDetailController::class,'index'])->name('komponeniksdetail.list');
Route::get('/komponeniksdetail/{id}/{name}/create',[TransaksiKomponenIksDetailController::class,'create'])->name('komponeniksdetail.create');
Route::get('/komponeniksdetail/{id}/{name}/edit',[TransaksiKomponenIksDetailController::class,'edit'])->name('komponeniksdetail.edit');
Route::delete('/komponeniksdetail/{id}',[TransaksiKomponenIksDetailController::class,'deleteData'])->name('komponeniksdetail.delete');

Route::post('/komponeniksdetail/@/{id}/{name}',[TransaksiKomponenIksDetailController::class,'store'])->name('komponeniksdetail.store');

Route::put('/komponeniksdetail/!/{id}/{name}',[TransaksiKomponenIksDetailController::class,'update'])->name('komponeniksdetail.update');

Route::post('/komponeniksdetail/listData',[TransaksiKomponenIksDetailController::class,'listData'])->name('komponeniksdetail.listData');