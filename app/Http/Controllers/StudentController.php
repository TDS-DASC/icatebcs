<?php

namespace App\Http\Controllers;

use App\Http\Requests\Students\StoreStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Address;
use App\Models\Center;
use App\Models\City;
use App\Models\Group;
use App\Models\State;
use App\Models\Student;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = StudentController::filter($request);

        $filters = [];
        $total_students = $students->count();
        if (isset($request->center_id)) {
            $filters['center_id'] = $request->center_id;
        }
        if (isset($request->academic_level)) {
            $filters['academic_level'] = $request->academic_level;
        }
        if (isset($request->job_condition)) {
            $filters['job_condition'] = $request->job_condition;
        }
        if (isset($request->city)) {
            $filters['city'] = $request->city;
        }

        // grupos cuyo curso està activo
        $groups = Group::select('id', 'key', 'course_id')->whereHas('course', function ($q) {
            $q->where('status', 'ACTIVO');
        })
        ->with('course:id,name')
        ->get();

        // return $groups;
        $widgets = [];
        $centers = Center::all();

        // solo ciudades que tienen estudiantes

        $cities = Student::with('address.city:id,name')->get();
        $cities = $cities->pluck('address.city')->unique()->sortBy('name')->values();

        foreach ($centers as $center) {
            // widgets
            $center_students = Student::where('center_id', $center->id)->get();
            array_push($widgets, ['center_id' => $center->id, 'center_name' => $center->name, 'total_students' => $center_students->count()]);
        }

        return view('admin.students.index', compact('students', 'centers', 'cities', 'groups', 'total_students', 'widgets', 'filters'));
    }

    public function create()
    {
        //if(!Auth::user()->can('Agregar Estudiantes')){
        //    return redirect()->back()->with('permission', 'Acceso no autorizado');
        //}
        $cities = City::all();
        $states = State::all();
        $centers = Center::all();
        //return $centers;
        return view('admin.students.create', compact('cities', 'states', 'centers'));
    }

    public function store(StoreStudentRequest $request)
    {
        $address = Address::create($request->all());
        if ($address) {
            $request['address_id'] = $address->id;
            $request['name'] = trim($request->name, '.');
            $request['first_name'] = trim($request->first_name, '.');
            $request['last_name'] = trim($request->last_name, '.');
            //validar si el usuario que registra pertenece a un centro
            if (auth()->user()->center_id) {
                $request['center_id'] = auth()->user()->center_id;
            }
            $last_student = Student::latest()->where('center_id', $request->center_id)->first();
            $student = Student::create($request->all());
            $year_id = -1;
            if ($student) {
                // no hay cambio de año
                $current_year = Carbon::now();
                if ($last_student && ($last_student->created_at->diffInYears($current_year) == 0)) {
                    $year_id = (int) substr($last_student->no_control, -4);
                }

                $student->no_control = $student->address->city->state->key.date('y').substr($student->center->key, -4).str_pad($year_id + 1, 4, '0', STR_PAD_LEFT);
                if ($request->hasFile('avatar_path')) {
                    $file = $request->file('avatar_path');
                    $name_file = $student->id.'_student'.'.'.$file->getClientOriginalExtension();
                    $path = $request->file('avatar_path')->storeAs(
                        'public/student/covers', $name_file
                    );
                    $student->avatar_path = $name_file;
                }

                $student->created_by = Auth::id();

                $student->save();

                return redirect()->route('student.index')->with('success', 'Proceso realizado correctamente');
            }
        }
    }

    public function get($id)
    {
        $student = Student::with('address.city.state', 'center')->get()->find($id);

        return response()->json([
            'message' => 'Registro consultado correctamente',
            'data' => $student,
        ], 200);
    }

    public function show($id)
    {
        $students = Student::with(
            'address.city.state', 
            'center', 
            'groups', 
            'create_author', 
            'update_author'
        )->get()->find($id);

        $students->birth_place = (State::find($students->birth_place));

        return view('admin.students.detail', compact('students'));
    }

    public function edit($id)
    {
        $cities = City::all();
        $states = State::all();
        $centers = Center::all();
        $student = Student::with('address.city.state', 'center')->get()->find($id);

        return view('admin.students.edit', compact('student', 'cities', 'states', 'centers'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->except(['avatar_path']));

        if ($student) {
            if ($student->avatar_path != 'cover.jpg' && $request->avatar_path != 'cover.jpg') {
                $path = storage_path().'/app/public/student/covers/'.$student->avatar_path;

                //borrar imagen
                if (File::exists($path)) {
                    File::delete($path);

                    $student->avatar_path = 'cover.jpg';
                }
            }
            //guardar cover
            if ($request->hasFile('avatar_path')) {
                $file = $request->file('avatar_path');
                $name_file = $student->id.'_student'.'.'.$file->getClientOriginalExtension();

                $path = $request->file('avatar_path')->storeAs(
                    'public/student/covers/', $name_file
                );
                $student->avatar_path = $name_file;
            }
            if ($student->address != null) {
                $student->address->fill($request->all());
                $student->push();
            }

            $student->save();

            return redirect()->route('student.index')->with('success', 'Proceso realizado correctamente');
            //return redirect()->back()->with('success', 'Proceso realizado correctamente');
        }
        //return $student;
        return redirect()->back()->with('error', $student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
        }
        //return $student;
        return redirect()->back()->with('success', 'Se borro el registro');
    }

    public static function filter(Request $request)
    {
        $students = Student::with('center', 'address')
        ->when($request->has('center_id'), function ($q) use ($request) {
            $q->where('center_id', $request->center_id);
        })
        ->when($request->has('academic_level'), function ($q) use ($request) {
            $q->where('academic_level', $request->academic_level);
        })
        ->when($request->has('job_condition'), function ($q) use ($request) {
            $q->where('job_condition', $request->job_condition);
        })
         ->when($request->has('city'), function ($q) use ($request) {
             $q->whereHas('address', function ($q) use ($request) {
                 $q->where('city_id', $request->city);
             });
         })

        ->get();

        return $students;
    }

    public function curpExists(Request $request)
    {
        $response = [];
        $response['id'] = Student::select('id')->where('curp', $request->curp)->first();
        $response['exists'] = $response['id'] ? true : false;

        return response($response);
    }

    public function attach_group(Request $request)
    {
        $group = Group::find($request->group_id);

        if ($group && ! $group->students->contains('id', $request->student_id)) { // solo si el estudiante no està asignado previamente
            $group->students()->syncWithoutDetaching([$request->student_id]);

            return redirect()->back()->with('success', 'El proceso se realizó exitosamente, se ha inscrito al estudiante en el grupo.');
        }

        return redirect()->back()->with('error', 'Ha ocurrido un error, puede que el estudiante ya este inscrito en el grupo.');
    }
}
