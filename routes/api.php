<?php

use App\Http\Controllers\api\GroupController;
use App\Http\Controllers\api\InstructorController;
use App\Http\Controllers\api\PlaceController;
use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\api\TrainingFieldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(['auth'])->group(function () {

    // rutas estudiantes
    Route::get('students-excel', [StudentController::class, 'generate_excel'])->name('students.excel');
    Route::post('students-import',[StudentController::class, 'excel_import'])->name('students.import');
    Route::get('students-reactivate', [StudentController::class, 'reactivate'])->name('student.reactivate');
    Route::post('students-group', [StudentController::class, 'change_group_status'])->name('students.change.group.status');
    Route::get('students-constancy', [StudentController::class,'generate_constancy'])->name('students.constancy');

    // rutas instructores
    Route::get('instructors-excel', [InstructorController::class, 'generate_excel'])->name('instructors.excel');
    Route::post('instructors-import', [InstructorController::class ,'excel_import'])->name('instructors.import');
    Route::get('instructors-pdf', [InstructorController::class, 'generate_pdf'])->name('instructors.pdf');
    Route::get('instructor/curp-exists',[InstructorController::class, 'curp_exists'])->name('instructors.curp.exists');
    Route::get('instructor-history',[InstructorController::class, 'generate_history'])->name('instructors.history');


    // rutas lugares
    Route::get('places-excel', [PlaceController::class, 'generate_excel'])->name('places.excel');
    Route::post('places-import', [PlaceController::class, 'excel_import'])->name('places.import');

    // rutas campos de formacion
    Route::get('training-fields-excel', [TrainingFieldController::class, 'generate_excel'])->name('training-fiels.excel');
    Route::post('training-fields-import', [TrainingFieldController::class, 'excel_import'])->name('training-fiels.import');
    Route::get('groups-excel', [GroupController::class, 'generate_excel'])->name('groups.excel');
    Route::post('groups-import', [GroupController::class, 'excel_import'])->name('groups.import');
//});