<?php

namespace App\Http\Controllers\api;

use App\Exports\ExportGroup;
use App\Exports\GroupExportSheet;
use App\Http\Controllers\Controller;
use App\Imports\GroupImport;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    //
    public function generate_excel(){
        $groups = Group::with('place.center', 'course' ,'students', 'instructor', 'days')->get();
        return (new ExportGroup($groups))->download('grupos.xlsx');
    }

    public function excel_import(Request $request){
  //      $path = Storage::path('grupos (2).xlsx');
        $path = $request->file('groups')->store('imports');
        $import = new GroupImport();    
        $import->import($path);

        $info = collect();
        $info->put('errors', $import->failures());
        $info->put('new_records_ids', $import->new_records);
        $info->put('new_record_count', $import->new_records->count());
   
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
}
