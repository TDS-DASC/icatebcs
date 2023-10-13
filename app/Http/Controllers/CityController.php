<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //get ciudades by estado
    public function get_cities_by_state($state_id)
    {
    	$cities = City::where('state_id',$state_id)
                		  ->get(); 

        if($cities){

          return response()->json([
                'message' => "Registro consultado correctamente",
                'code' => 2,
                'data' => $cities
            ], 200);

        }

        return response()->json([
            'message' => "Error al consultar",
            'code' => -2,
            'data' => null
        ], 200);
    }
}
