<?php

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

Route::get('/',[App\Http\Controllers\LoginController::class,'index'])->name('login');
Route::get('/signup',[App\Http\Controllers\RegisterController::class,'index'])->name('register');

Route::group(["middleware" => ["admin"]], function(){
    //
Route::get('/category',[App\Http\Controllers\AdminController::class,'category'])->name('adminCategory');
Route::get('/announcement',[App\Http\Controllers\AdminController::class,'announcement'])->name('adminAnnouncement');
Route::get('/feed',[App\Http\Controllers\AdminController::class,'index'])->name('adminFeed');
Route::get('/edit/profile',[App\Http\Controllers\AdminController::class,'editProfPhotoAdmin'])->name('editProfilePhotoAdmin');
});

Route::group(["middleware" => ["member"]], function(){
    
    Route::get('/member/feed',[App\Http\Controllers\MemberController::class,'index'])->name('memberFeed');
    Route::get('/member/announcement',[App\Http\Controllers\MemberController::class,'announcement'])->name('memberAnnouncement');
    Route::get('/member/category',[App\Http\Controllers\MemberController::class,'category'])->name('memberCategory');
    Route::get('/member/edit/profile',[App\Http\Controllers\MemberController::class,'editProfile'])->name('memberEditProfile');
});

Route::get('/logout',[App\Http\Controllers\MemberController::class,'logout'])->name('logout');

