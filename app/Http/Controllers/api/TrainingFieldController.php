<?php

namespace App\Http\Controllers\api;

use App\Exports\ExportTrainingField;
use App\Http\Controllers\Controller;
use App\Imports\TrainingFieldImport;
use App\Models\TrainingField;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class TrainingFieldController extends Controller
{
    public function generate_excel(){
        $training_fields = TrainingField::all();
  //     return $training_fields;
        return Excel::download(new ExportTrainingField($training_fields),'trainingFields.xlsx');
    }

    public function excel_import(Request $request){
        
        $import = new TrainingFieldImport();
          $path = $request->file('training_fields')->store('imports');
        // $path = Storage::path('trainingFields (1).xlsx');
        $import->import($path);
        $info = collect();
        $info->put('errors', $import->failures());
        
        // error_log(json_encode($import->errors()));/
        // error_log(json_encode($import->failures()));
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
}
