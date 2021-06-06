<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HomeController;
use App\Http\Controllers\Student\StudentController as StudentController;

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

/*Route::get('/', function () {
    return view('home');
});*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

	Route::get('/home', [HomeController::class, 'index'])->name('home');

	/* student routing*/
	Route::get('student-list',[StudentController::class, 'index'])->name('student-list');
	Route::get('add-student',[StudentController::class, 'create'])->name('add-student');
	Route::post('add-student',[StudentController::class, 'store'])->name('save-student');
	Route::get('view-student-detail/{id}',[StudentController::class, 'show'])->name('view-student-detail');

	/*get state list*/
	Route::get('state-list/{id}',[HomeController::class, 'getStateList'])->name('state-list');
	Route::get('city-list/{id}',[HomeController::class, 'getCityList'])->name('city-list');
});