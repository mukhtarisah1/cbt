<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestAssignmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestQuestionController;
use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;

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

    // Route::get('/login', function(){
    //     return redirect('/');
    // });

    Route::get('/', [AuthController::class, 'loadLogin']);
    Route::post('/login', [AuthController::class, 'userLogin'])->name('login');

    Route::get('/studentLogin', [AuthController::class, 'loadStudentLogin'])->name('student.login');
    Route::post('/studentlogin', [AuthController::class, 'studentLogin'])->name('loginStudent'); 

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/forget-password', [AuthController::class, 'forgetPasswordLoad']);
    Route::post('/forget-password', [AuthController::class, 'forgetPasswordLoad'])->name('forgetPassword');

    Route::group(['middleware'=>['web', 'checkAdmin']],function(){
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
        Route::post('addSubject', [AdminController::class, 'addSubject'])->name('addSubject');
    });

    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);




    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');






    Route::middleware(['auth:students'])->group(function () {
        Route::get('tests/{test}/startInstructions', [TestController::class, 'startTestInstructions'])->name('students.tests.startInstructions');
        Route::get('tests/{test}/start', [TestController::class, 'startTest'])->name('students.test.start');
           
    }); 
    
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

    Route::post('courses/{course}/tests/{test}/assign', [TestAssignmentController::class, 'store']) ->name('courses.tests.assign.store');
    Route::get('courses/{course}/tests/{test}/assign/create', [TestAssignmentController::class, 'create']) ->name('courses.tests.assign.create');

    //levels routes
    Route::get('/levels', [LevelController::class, 'index'])->name('levels.index');
    Route::get('/levels/create', [LevelController::class, 'create'])->name('levels.create');
    Route::post('/levels', [LevelController::class, 'store'])->name('levels.store');
    Route::get('/levels/{level}', [LevelController::class, 'show'])->name('levels.show');
    Route::get('/levels/{level}/edit', [LevelController::class, 'edit'])->name('levels.edit');
    Route::put('/levels/{level}', [LevelController::class, 'update'])->name('levels.update');
    Route::delete('/levels/{level}', [LevelController::class, 'destroy'])->name('levels.destroy');

    


//students related routes
Route::get('/get-students/{level}', [TestAssignmentController::class, 'getStudents'])->name('get.students');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');