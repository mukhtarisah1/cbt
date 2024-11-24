<?php

use App\Exports\ResultsExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestAssignmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestQuestionController;
use App\Models\Course;
use App\Models\Test;
use App\Models\TestResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
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
    Route::middleware(['checkAdmin'])->group(function(){
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::get('courses/{course}/tests/{test}/results', [TestController::class, 'showResults'])->name('courses.tests.results');

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

        // Route to list all users
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

        //routes to export to pdf and excel
        Route::get('/results/export/excel', function () {
            return Excel::download(new ResultsExport, 'results.xlsx');
        })->name('results.export.excel');

        Route::get('/results/export/pdf', function () {
            $test = Test::find(request('test_id'));
            $course = Course::find(request('course_id'));
            $results = TestResult::where('test_id', $test->id)->get();

            $pdf = Pdf::loadView('results.pdf', compact('test', 'course', 'results'));
            return $pdf->download('results.pdf');
        })->name('results.export.pdf');
    });
    




//student routes for student user functions

    Route::middleware(['auth:students'])->group(function () {
    Route::get('tests/{test}/startInstructions', [TestController::class, 'startTestInstructions'])->name('students.tests.startInstructions');
    Route::get('tests/{test}/start', [TestController::class, 'startTest'])->name('students.test.start');
    Route::post('tests/{test}/finish', [TestController::class, 'submitTestPost'])->name('students.test.finish');
    Route::get('finishtestscreen', [TestController::class, 'finishTest'])->name('finishScreen');  
    }); 
    
    



