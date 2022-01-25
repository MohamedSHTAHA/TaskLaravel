<?php

use App\Http\Controllers\StudentController;
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

/*
*
*Students
*
*/
Route::post('/students/import', [StudentController::class,'importData'])->name('students.import');
//Route::post('/students/import', [StudentController::class,'import'])->name('students.import');
Route::get('/students/data', [StudentController::class,'data'])->name('students.data');
Route::resource('students', StudentController::class);

