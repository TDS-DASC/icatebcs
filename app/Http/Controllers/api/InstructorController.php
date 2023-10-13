<?php

namespace App\Http\Controllers\api;

use App\Exports\ExportInstructor;
use App\Http\Controllers\Controller;
use App\Imports\InstructorsImport;

use App\Models\Instructor;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class InstructorController extends Controller
{
    public function generate_excel(){
        $instructors = Instructor::with('bank:id,marca' , 'center:id,name', 'address.city')->get();
        foreach($instructors as $instructor){
            $instructor->birth_place = State::find($instructor->birth_place)->name;
        }
        return Excel::download(new ExportInstructor($instructors), 'instructors.xlsx');
    }

    public function excel_import(Request $request){       
        $import = new InstructorsImport();
        $file = $request->file('instructores')->store('imports');
        // $file = Storage::path('instructors (22).xlsx');
        $import->import($file); 

    
        $info = collect();
        $info->put('errors', $import->failures());
    
        // error_log(json_encode($import->errors()));
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

    public function generate_pdf(Request $request){
        $data = Instructor::where('id', $request->id)->with('address.city.state', 'bank', 'center')->first();
        if($data){
            return PDF::loadView('admin.instructors.exports.index', compact('data'))->download('instructor.pdf');
        }
        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => [],
            'errors' => null
        ], 400);
    }

    public function curp_exists(Request $request){
        $response = [];
        $response['id'] = Instructor::select('id')->where('curp', $request->curp)->first()->id ?? null;
        $response['exists'] = $response['id']? true:false;
        return response()->json([
            'message' => "Registro consultado correctamente",
            'code' => 2,
            'data' => [$response],
            'errors' => null
        ], 200);
    }

    public function generate_history(Request $request){
        $instructor = Instructor::where('id', $request->id)->with('address.city.state', 'courses')->first();
    
        if($instructor){
            $data = collect(['instructor' => $instructor]);
            $instructor->groups->each(function($value, $key){
                $value->loadCount('students');
                $value->load('course:id,name,duration_course');
            });
            
            return PDF::loadView('admin.instructors.exports.history', compact('data'))->setPaper('letter', 'landscape')->download('history.pdf');
        }
        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -2,
            'data' => [],
            'errors' => null
        ], 400);
    }
}