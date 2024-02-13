<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');

Route::get('/login', function(){
    return redirect('/');
});

Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'userLogin'])->name('userLogin');

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

use App\Http\Controllers\TestController;

Route::middleware(['auth'])->group(function () {
    
    Route::get('create/tests', [TestController::class, 'createView'])->name('createView.index');
    Route::get('courses/{course}/tests', [TestController::class, 'index'])->name('courses.tests.index');  
    Route::get('courses/{course}/tests/create', [TestController::class, 'create'])->name('courses.tests.create');
    Route::post('courses/{course}/tests', [TestController::class, 'store'])->name('courses.tests.store');
    Route::get('courses/{course}/tests/{test}/edit', [TestController::class, 'edit'])->name('courses.tests.edit');
    Route::put('courses/{course}/tests/{test}', [TestController::class, 'update'])->name('courses.tests.update');
    Route::delete('courses/{course}/tests/{test}', [TestController::class, 'destroy'])->name('courses.tests.destroy');
}); 