<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ListGroupController;
use App\Http\Controllers\UserController;
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
    return view('login');
});
Route::get('loginpage',[UserController::class,'index'])->name('loginpage');
Route::post('login',[UserController::class,'login'])->name('login');


Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('group',[GroupController::class,'index'])->name('group.index')->middleware('auth');
Route::get('add/group',[GroupController::class,'create'])->name('group.create')->middleware('auth');
Route::get('edit/group/{id}',[GroupController::class,'edit'])->name('group.edit')->middleware('auth');
Route::post('store/group',[GroupController::class,'store'])->name('group.store')->middleware('auth');
Route::post('update/group/{id}',[GroupController::class,'update'])->name('group.update')->middleware('auth');
Route::get('delete/group/{id}',[GroupController::class,'delete'])->name('group.delete')->middleware('auth');


Route::group([
    'prefix' => 'listgroup',
    'middleware' => 'auth',
], function() {
    Route::get('index',[ListGroupController::class,'index'])->name('listgroup.index');
    Route::get('datatable',[ListGroupController::class,'datatable'])->name('listgroup.datatable');
    Route::get('add/listgroup',[ListGroupController::class,'create'])->name('listgroup.create');
    Route::get('search/listgroup',[ListGroupController::class,'search'])->name('search.group');
    Route::post('store/listgroup',[ListGroupController::class,'store'])->name('store.group');
    Route::get('edit/listgroup/{id?}',[ListGroupController::class,'edit'])->name('listgroup.edit');
    Route::post('update/listgroup/{id?}',[ListGroupController::class,'update'])->name('listgroup.update');
    Route::get('delete/listgroup/{id?}',[ListGroupController::class,'delete'])->name('listgroup.delete');
});
