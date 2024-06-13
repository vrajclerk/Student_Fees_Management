<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
Route::post('/students/search', [StudentController::class, 'search'])->name('students.search');
Route::post('/students/download', [StudentController::class, 'download'])->name('students.download');
Route::get('/students/trash', [StudentController::class, 'trash'])->name('students.trash');

Route::get('/students/restore/{id}',[StudentController::class,'restore'])->name('student.restore');
Route::get('/students/force-delete/{id}',[StudentController::class,'forceDelete'])->name('students.force-delete');

