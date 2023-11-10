<?php

namespace App\Http\Controllers\api;
use App\Exports\ExportStudent;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Group;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Http\Filters\StudentFilter;

class StudentController extends Controller
{
    public function index(StudentFilter $filter)
    {
        return Student::filter($filter)->with('center', 'address')->paginate(8);
    }

       public function generate_excel(Request $request){
        $students = Student::with('center:id,name', 'address')
        ->when($request->has('center_id'), function($q) use($request){
            $q->where('center_id', $request->center_id);
        })
        ->when($request->has('academic_level'), function($q) use($request){
            $q->where('academic_level', $request->academic_level);
        })
        ->when($request->has('job_condition'), function($q) use($request){
            $q->where('job_condition', $request->job_condition);
        })
         ->when($request->has('city'), function($q) use($request){
            $q->whereHas('address', function($q) use($request){
                $q->where('city_id', $request->city);
            });
        })
        ->get();
        foreach($students as $student){
            $student->birth_place = State::find($student->birth_place)->name ?? null;
        }
//return $students;
     return Excel::download(new ExportStudent($students), 'capacitandos.xlsx');
    }

    public function excel_import(Request $request){
        $import = new StudentsImport();
        $file = $request->file('capacitandos')->store('imports');
        // $file = Storage::path('capacitandos (10).xlsx');
        // $file = Storage::path(storage_path('app/capacitandos_10.xlsx'));
        $import->import($file);

        $info = collect();
        $info->put('errors', $import->failures());
        $info->put('new_records', $import->new_records);

        if($import->failures()->isEmpty()){
            return response()->json([
                'message' => "Registros insertados correctamente",
                'code' => 2,
                'data' => $info,
                'errors' => null
            ], 200);
        }

        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => $info,
            'errors' => null
        ], 200);
    }

    public function reactivate(Request $request){
        $student = Student::onlyTrashed()->where('curp', $request->curp)->first();
        if($student){
            $student->restore();
            return response()->json([
                    'message' => "Registro recuperado correctamente",
                    'code' => 2,
                    'data' => $student->id,
                    'errors' => null
                ], 200);
        }
        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => $request->curp,
            'errors' => null
        ], 200);
    }

    public function change_group_status(Request $request){
        $group = Group::find($request->group_id);
        if($group->students->contains('id', $request->student_id)){

            $group->students()->sync([$request->student_id => ['status' => $request->status]], false);
            return response()->json([
                'message' => "Registro editado correctamente",
                'code' => 2,
                'data' => ['status' => $request->status, 'group_id' =>  $request->group_id, 'status' => $request->status],
                'errors' => null
            ], 200);
        }

        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => null,
            'errors' => null
        ], 200);
    }
    public function generate_constancy(Request $request){
        $student = Student::find($request->student_id);

        $group = ($student)? $student->groups->find($request->group_id) : null;

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');

        if($group){
            $group->load(['course:id,name,duration_course,type_course', 'course.themes:course_id,name', 'center:id,name,address_id', 'center.address.city.state:id,name']);
            // dd($group);
         return PDF::loadView('admin.students.exports.constancia', compact('student', 'group', 'day', 'month', 'year'))->download("constancia_".time().".pdf");
        }
        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => [],
            'errors' => null
        ], 400);
    }
}
