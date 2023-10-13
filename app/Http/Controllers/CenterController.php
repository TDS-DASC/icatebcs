<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Center;
use App\Models\City;
use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;

use File;
class CenterController extends Controller
{
    public function index(){
        $centers = Center::with('address.city.state')->get();
        $cities = City::all();
        $states = State::all();
        //return $centers;
        return view('admin.centers.index', compact('centers', 'cities', 'states'));
    }
    public function create(){
        $cities = City::where('state_id', 3)->get();
        $states = State::all();
        //return $cities;
        return view('admin.centers.create', compact('cities','states'));
    }
    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'center_type' => 'required',
            'telephone_number' => 'required',
            'director_name' => 'required',
            'director_position' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ];
        $request->validate($rules);

        $address = Address::create($request->all());
        if($address){
            $request['address_id'] = $address->id;

            $center = Center::create($request->all());
            if ($center) {
                //guardar cover
                if($request->hasFile('cover_path')){

                    $file = $request->file('cover_path');
                    $name_file = $center->id."_center".".".$file->getClientOriginalExtension();

                    $path = $request->file('cover_path')->storeAs(
                        'public/center/covers/', $name_file
                    );

                    $center->cover_path = $name_file;
                    $center->save();
                }
                return redirect()->back()->with('success', 'ok');
            }
        }
    }
    public function get($id){
        $center = Center::with('address.city.state', 'instructors', 'places.address', 'students')->get()->find($id);
        return response()->json([
            'message' => 'Registro consultado correctamente',
            'data' => $center
        ], 200); 
    }
    public function show($id){
        $center = Center::with('address.city.state', 'places.address')->get()->find($id);
        
        $students = Student::where('center_id', $id)->get();
        //return $center and students;
        return view('admin.centers.detail', compact('center', 'students'));
    }
    public function edit(Center $center){
        $center = Center::with('address.city.state')->get()->find($id);
        $cities = City::all();
        $states = State::all();
        //return $center;

        return view('admin.centers.edit', compact('center', 'cities', 'states'));
    }
    public function update(Request $request){
        
        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'center_type' => 'required',
            'telephone_number' => 'required',
            'director_name' => 'required',
            'director_position' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ];
        $request->validate($rules);
        $center = Center::where('id', $request->id)->first();
        if($center->update($request->except(['cover_path']))){
            if($center->address != null){
                $center->address->fill($request->all());
                $center->push();
            }
            if($center->cover_path != "cover.jpg" && $request->cover_path != "cover.jpg"){
                $path = storage_path() . "/app/public/center/covers/".$center->cover_path;

                //borrar imagen
                if (File::exists($path)) {

                    File::delete($path);

                    $center->cover_path = 'cover.jpg';
                }
            }
            //guardar cover
            if($request->hasFile('cover_path')){
                
                $file = $request->file('cover_path');
                $name_file = $center->id."_cover".".".$file->getClientOriginalExtension();

                $path = $request->file('cover_path')->storeAs(
                    'public/center/covers/', $name_file
                );
                $center->cover_path = $name_file;
            }
            $center->save();
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'no se actualizo');
    }
    public function destroy($id){
        $center = Center::find($id);
        if($center){
            $center->delete();
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('errror', 'no se elimino');
    }
    public function update_cover(Request $request){
        $center = Center::find($request->id);

          if($center){
              //no eliminar img por defecto
              if($center->cover_path != "cover.jpg"){
                  $path = storage_path() . "/app/public/center/covers/".$center->cover_path;

                  //borrar imagen
                  if (File::exists($path)) {

                      File::delete($path);

                      $center->cover_path = null;
                  }
              }
              //guardar cover
              if($request->hasFile('cover_file')){

                  $file = $request->file('cover_file');
                  $name_file = $center->id."_cover".".".$file->getClientOriginalExtension();

                  $path = $request->file('cover_file')->storeAs(
                      'public/center/covers/', $name_file
                  );
                  $center->cover_path = $name_file;
              }
              if($center->save()){
                return redirect()->back()->with('success', 'ok');
              }
          }
    }
}
