<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AbsenceController;
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



Route::get('/test/{param1}/{param2}', [TestController::class, 'test']);
Route::get('/absences/{person_name}/{description}/{number}', [AbsenceController::class,'store'])->name('absences.store');

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout',[App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('custom.logout');
Route::get('/absences',[AbsenceController::class,'index']);
Route::get('/check-phone/{phone}', [AbsenceController::class,'checkPhoneNumberRegistered']);
Route::get('/register-person/{name}/{phone}',[AbsenceController::class,'registerPerson']);
