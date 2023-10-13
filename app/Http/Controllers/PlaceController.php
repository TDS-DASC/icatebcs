<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Center;
use App\Models\City;
use App\Models\Place;
use App\Models\State;
use Illuminate\Http\Request;

use File;

class PlaceController extends Controller
{
    //
    public function index(){
        $places = Place::with('address.city.state', 'center')->get();
        $centers = Center::all();
        $cities = City::all();
        $states = State::all();
        return view('admin.places.index', compact('places', 'centers', 'cities', 'states'));
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'telephone_number' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'center_id' => 'required'
        ];
        $request->validate($rules);
        $address = Address::create($request->all());
        if ($address){
            $request['address_id'] = $address->id;
            $place = Place::create($request->all());
            if($place){
                //guardar cover
                if($request->hasFile('cover_path')){

                    $file = $request->file('cover_path');
                    $name_file = $place->id."_place".".".$file->getClientOriginalExtension();

                    $path = $request->file('cover_path')->storeAs(
                      'public/place/covers/', $name_file
                    );
                    $place->cover_path = $name_file;
                    
                }
                $place->key = date("y") . $request['center_id'] . str_pad($place->id, 4, '0', STR_PAD_LEFT);
                $place->save();
            }
            return redirect()->back()->with('success', 'ok');
        }
    }
    public function get($id){
        $place = Place::with('address.city.state', 'center')->get()->find($id);
        return response()->json([
            'message' => 'Registro consultado correctamente',
            'data' => $place,
        ], 200); 
    }
    public function show($id){
        $states = State::with('cities')->get();
        $centers = Center::select('id', 'name')->get();
        $place = Place::with('address.city.state', 'center', 'groups.course:id,name' )->get()->find($id);
       # return $place;
        return view('admin.places.detail', compact('place', 'states', 'centers'));
    }
    public function edit($id){
        $cities = City::all();
        $centers = Center::all();
        $states  = State::all(); 
        $place = Place::with('address.city.state', 'center')->get()->find($id);
        return view('admin.places.edit', compact('place', 'centers', 'cities', 'states'));
    }
    public function update(Request $request){
        $rules = [
            'name' => 'required',
            'telephone_number' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'center_id' => 'required'
        ];
        $request->validate($rules);
        $place = Place::where('id', $request->id)->first();
        if($place->update($request->except(['cover_path']))){
            if($place->cover_path != "cover.jpg" && $request->cover_path != "cover.jpg"){
                $path = storage_path() . "/app/public/place/covers/".$place->cover_path;

                //borrar imagen
                if (File::exists($path)) {

                    File::delete($path);

                    $place->cover_path = 'cover.jpg';
                }
            }
            //guardar cover
            if($request->hasFile('cover_path')){

                $file = $request->file('cover_path');
                $name_file = $place->id."_cover".".".$file->getClientOriginalExtension();

                $path = $request->file('cover_path')->storeAs(
                    'public/place/covers/', $name_file
                );
                $place->cover_path = $name_file;
                $place->save();
            }
            if($place->address != null){
                $place->address->fill($request->all());
                $place->push();
            }
            return redirect()->back()->with('success', 'Proceso realizado correctamente, se han actualizado los datos.');
        }
        return redirect()->back()->with('error', 'Ha ocurrido un error, no fue posible actualizar los datos.');
    }

    public function destroy($id){
        $place = Place::find($id);
        if($place){
            $place->delete();
            return redirect()->back()->with('success', 'ok');
        }
    }

    //get lugares por centros
    public function get_places_by_center($center_id)
    {
    	$places= Place::where('center_id',$center_id)
                		  ->get(); 

        if($places){

          return response()->json([
                'message' => "Registro consultado correctamente",
                'code' => 2,
                'data' => $places
            ], 200);

        }

        return response()->json([
            'message' => "Error al consultar",
            'code' => -2,
            'data' => null
        ], 200);
    }
}
