

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarkController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
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




Route::group(['middleware' => ['auth']], function () {
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

Route::prefix('students/{student}')->group(function () {
    Route::get('marks', [MarkController::class, 'index'])->name('students.marks.index');
    Route::get('marks/create', [MarkController::class, 'create'])->name('students.marks.create');
    Route::post('marks', [MarkController::class, 'store'])->name('students.marks.store');
    Route::get('marks/{mark}/edit', [MarkController::class, 'edit'])->name('students.marks.edit');
    Route::put('marks/{mark}/update', [MarkController::class, 'update'])->name('students.marks.update');
    Route::delete('marks/{mark}/ddelete', [MarkController::class, 'destroy'])->name('students.marks.destroy');
    


Route::post('marks/download', [MarkController::class, 'download'])->name('students.marks.download');


});
});

