<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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


Route::get('/',[PostController::class,'index'])->name('home');

Route::post('/user/save',[UserController::class,'save'])->name('user.save');
Route::post('/user/check',[UserController::class,'check'])->name('user.check');
Route::post('/user/dashboard',[UserController::class,'logout'])->name('user.logout');
Route::group(['middleware'=>['AuthCheck']],function(){

    Route::get('/user/register',[UserController::class,'register'])->name('user.register');
    Route::get('/user/login',[UserController::class,'login'])->name('user.login');
    Route::get('/user/dashboard',[UserController::class,'dashboard'])->name('user.dashboard');

});

Route::get('/user/dashboard/post/create', [PostController::class,'create'])->name('post.create');
Route::post('/user/dashboard/post/store',[PostController::class,'store'])->name('post.store');

Route::get('/user/dashboard/post/edit/{id}', [PostController::class,'edit'])->name('post.edit');
Route::put('/user/dashboard/post/update/{id}',[PostController::class,'update'])->name('post.update');

Route::delete('/user/dashboard/post/delete/{id}',[PostController::class,'destroy'])->name('post.delete');