<?php

namespace App\Http\Controllers\api;

use App\Exports\ExportPlace;
use App\Exports\ExportPlaceGroups;
use App\Http\Controllers\Controller;
use App\Imports\PlaceImport;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class PlaceController extends Controller
{
    public function generate_excel()
    {
        $places = Place::with('address.city.state', 'center')->get();

        return Excel::download(new ExportPlace($places), 'places.xlsx');
    }

    public function generate_excel_for(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
        ]);

        $place = Place::find($request->place_id);

        return Excel::download(new ExportPlaceGroups($request->id), 'grupos_'.$place->name.'.xlsx');
    }

    public function excel_import(Request $request)
    {
        $import = new PlaceImport();
        $file = $request->file('places')->store('imports');
        // $file = Storage::path('places.xlsx');
        $import->import($file);
        // dd($import->new_records);

        $info = collect();
        $info->put('errors', $import->failures());
        $info->put('new_records', $import->new_records);

        if ($import->failures()->isEmpty()) {
            return response()->json([
                'message' => 'Registros insertados correctamente',
                'code' => 2,
                'data' => $info,
                'errors' => null,
            ], 200);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -2,
            'data' => $info,
            'errors' => null,
        ], 200);
    }
}
