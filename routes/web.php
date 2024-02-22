<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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



Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'adminRegister'])->name('adminRegister');

Route::get('/login', function(){
    return redirect('/');
});

Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'userLogin'])->name('login'); 

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forget-password', [AuthController::class, 'forgetPasswordLoad']);
Route::post('/forget-password', [AuthController::class, 'forgetPasswordLoad'])->name('forgetPassword');

Route::group(['middleware'=>['web', 'checkAdmin']],function(){
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
    Route::post('addSubject', [AdminController::class, 'addSubject'])->name('addSubject');
});
Route::group(['middleware'=>['web', 'checkStudent']],function(){
    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
});



Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');




Route::middleware(['auth'])->group(function () {
    
    Route::get('create/tests', [TestController::class, 'createView'])->name('createView.index');
    Route::get('courses/tests', [TestController::class, 'index'])->name('courses.tests.index');  
    Route::get('courses/{course}/tests/create', [TestController::class, 'create'])->name('courses.tests.create');
    Route::post('courses/{course}/tests', [TestController::class, 'store'])->name('courses.tests.store');
    Route::get('courses/{course}/tests/{test}', [TestController::class, 'show'])->name('courses.tests.show');
    Route::put('courses/{course}/tests/{test}', [TestController::class, 'update'])->name('courses.tests.update');
    Route::get('courses/{course}/tests/{test}/edit', [TestController::class, 'edit'])->name('courses.tests.edit');
    Route::delete('courses/{course}/tests/{test}', [TestController::class, 'destroy'])->name('courses.tests.destroy');


    Route::get('courses/{course}/tests/{test}/questions/create', [TestQuestionController::class, 'create']) ->name('courses.tests.questions.create');
    Route::post('courses/{course}/tests/{test}/questions', [TestQuestionController::class, 'store'])->name('courses.tests.questions.store');  
    Route::put('courses/{course}/tests/{test}/questions/{question}', [TestQuestionController::class, 'update'])->name('courses.tests.questions.update');
    Route::get('courses/{course}/tests/{test}/questions/{question}/edit', [TestQuestionController::class, 'edit'])->name('courses.tests.questions.edit');
    Route::get('courses/{course}/tests/{test}/questions/{question}/confirm-delete', [TestQuestionController::class, 'confirmDelete'])->name('courses.tests.questions.confirm-delete');
    Route::delete('courses/{course}/tests/{test}/questions/{question}', [TestQuestionController::class, 'destroy'])->name('courses.tests.questions.destroy');
}); 



Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');