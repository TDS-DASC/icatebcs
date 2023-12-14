<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingFieldController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

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


/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::get('logout/view', function () {
    return view('logout');
});
Route::get('register', function () {
    return redirect('registro');
});
//Ciudades por estado para formularios
Route::get('cities/{state_id}', [CityController::class, 'get_cities_by_state']);
Route::get('center/hydrate', [CenterController::class, 'hydrate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [StudentController::class, 'index']);
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');


    //rutas crud estudiantes
    Route::get('/student', [StudentController::class,'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class,'create'])->name('student.create');
    Route::post('/student', [StudentController::class,'store'])->name('student.store');
    Route::get('/student/{id}/edit', [StudentController::class,'edit'])->name('student.edit');
    Route::get('/student/{id}', [StudentController::class,'show'])->name('student.show');
    Route::get('/student/get/{id}', [StudentController::class,'get'])->name('student.get');
    Route::put('/student/{student}', [StudentController::class,'update'])->name('student.update');
    Route::get('/student/{id}/delete', [StudentController::class,'destroy'])->name('student.destroy');

    Route::post('student/curp-exists',[StudentController::class, 'curpExists'])->name('student.curp.exists');
    Route::post('studente/group-assign', [StudentController::class, 'attach_group'])->name('student.group.assign');
    //rutas crud perfiles
    Route::get('/profile', [RoleController::class,'index'])->name('profile.index');
    Route::get('/profile/create', [RoleController::class,'create'])->name('profile.create');
    Route::post('/profile', [RoleController::class,'store'])->name('profile.store');
    Route::get('/profile/{id}/edit', [RoleController::class,'edit'])->name('profile.edit');
    Route::get('/profile/{id}', [RoleController::class,'show'])->name('profile.show.user');
    Route::get('/profile/get/{id}', [RoleController::class,'get'])->name('profile.get');
    Route::put('/profile/{id}', [RoleController::class,'update'])->name('profile.update');
    Route::get('/profile/{id}/delete', [RoleController::class,'destroy'])->name('profile.destroy');

    //rutas crud centros
    Route::get('/center', [CenterController::class,'index'])->name('center.index');
    Route::get('/center/create', [CenterController::class,'create'])->name('center.create');
    Route::post('/center', [CenterController::class,'store'])->name('center.store');
    Route::get('/center/{id}/edit', [CenterController::class,'edit'])->name('center.edit');
    Route::get('/center/{id}', [CenterController::class,'show'])->name('center.show');
    Route::get('/center/get/{id}', [CenterController::class,'get'])->name('center.get');
    Route::put('/center/{id}', [CenterController::class,'update'])->name('center.update');
    Route::get('/center/{id}/delete', [CenterController::class,'destroy'])->name('center.destroy');


    //rutas crud para lugares (pertenecen a un centro)
    Route::get('/place', [PlaceController::class,'index'])->name('place.index');
    Route::get('/place/create', [PlaceController::class,'create'])->name('place.create');
    Route::post('/place', [PlaceController::class,'store'])->name('place.store');
    Route::get('/place/{id}/edit', [PlaceController::class,'edit'])->name('place.edit');
    Route::get('/place/{id}', [PlaceController::class,'show'])->name('place.show');
    Route::get('/place/get/{id}', [PlaceController::class,'get'])->name('place.get');
    Route::put('/place/{id}', [PlaceController::class,'update'])->name('place.update');
    Route::get('/place/{id}/delete', [PlaceController::class,'destroy'])->name('place.destroy');
    Route::get('/places/{id}', [PlaceController::class,'get_places_by_center']);

    //rutas crud para campos de formacion (los cursos pertenecen a un campo)
    Route::get('/training-field', [TrainingFieldController::class,'index'])->name('training-field.index');
    Route::get('/training-field/create', [TrainingFieldController::class,'create'])->name('training-field.create');
    Route::post('/training-field', [TrainingFieldController::class,'store'])->name('training-field.store');
    Route::get('/training-field/{id}/edit', [TrainingFieldController::class,'edit'])->name('training-field.edit');
    Route::get('/training-field/{id}', [TrainingFieldController::class,'show'])->name('training-field.show');
    Route::get('/training-field/get/{id}', [TrainingFieldController::class,'get'])->name('training-field.get');
    Route::put('/training-field/{id}', [TrainingFieldController::class,'update'])->name('training-field.update');
    Route::get('/training-field/{id}/delete', [TrainingFieldController::class,'destroy'])->name('training-field.destroy');

    //rutas crud para instructores o evaluadores (los cursos pertenecen a un campo)
    Route::get('/instructor', [InstructorController::class,'index'])->name('instructor.index');
    Route::get('/instructor/create', [InstructorController::class,'create'])->name('instructor.create');
    Route::post('/instructor', [InstructorController::class,'store'])->name('instructor.store');
    Route::get('/instructor/{id}/edit', [InstructorController::class,'edit'])->name('instructor.edit');
    Route::get('/instructor/{id}', [InstructorController::class,'show'])->name('instructor.show');
    Route::get('/instructor/get/{id}', [InstructorController::class,'get'])->name('instructor.get');
    Route::put('/instructor/{instructor}', [InstructorController::class,'update'])->name('instructor.update');
    Route::get('/instructor/{id}/delete', [InstructorController::class,'destroy'])->name('instructor.destroy');

    //rutas cursos
    Route::get('/course', [CourseController::class,'index'])->name('course.index');
    Route::get('/course/create', [CourseController::class,'create'])->name('course.create');
    Route::post('/course', [CourseController::class,'store'])->name('course.store');
    Route::get('/course/{course}/edit', [CourseController::class,'edit'])->name('course.edit');
    Route::get('/course/{id}', [CourseController::class,'show'])->name('course.show');
    Route::get('/course/get/{id}', [CourseController::class,'get'])->name('course.get');
    Route::put('/course/{course}', [CourseController::class,'update'])->name('course.update');
    Route::get('/course/{id}/delete', [CourseController::class,'destroy'])->name('course.destroy');
    //rutas grupos
    Route::get('/group', [GroupController::class,'index'])->name('group.index');
    Route::get('/group/create', [GroupController::class,'create'])->name('group.create');
    Route::post('/group', [GroupController::class,'store'])->name('group.store');  //<=
    Route::get('/group/{id}/delete', [GroupController::class,'destroy'])->name('group.destroy');
    Route::get('/group/{id}', [GroupController::class,'show'])->name('group.show');
    Route::get('/group/{id}/edit', [GroupController::class,'edit'])->name('group.edit');
    Route::put('/group', [GroupController::class,'update'])->name('group.update');


    Route::get('/group/get/{id}', [GroupController::class,'get'])->name('group.get');

    //Rutas usuarios con roles
    Route::get('/user', [UserController::class,'index'])->name('user.index');
    Route::post('/user', [UserController::class,'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class,'update'])->name('user.update');
    Route::get('/user/{id}/delete', [UserController::class,'destroy'])->name('user.destroy');

    // Reportes
    Route::get('/reports/download', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download/students', [ReportController::class, 'students'])->name('reports.download.instructors');
    Route::get('/reports/download/instructors', [ReportController::class, 'instructors'])->name('reports.download.instructors');
});
