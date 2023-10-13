<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequest;
use App\Models\Address;
use App\Models\Bank;
use App\Models\Center;
use App\Models\City;
use App\Models\Instructor;
use App\Models\State;
use App\Models\TrainingField;
use Illuminate\Http\Request;

use File;
class InstructorController extends Controller
{
    //

    public function index(){
        $instructors = Instructor::with('center')->get();
        
        return view('admin.instructors.index', compact('instructors'));
    }
    public function create(){
        $cities = City::all();
        $states = State::all();
        $centers = Center::all();
        $training_fields = TrainingField::all();
        $banks = Bank::orderBy('marca')->get();
        return view('admin.instructors.create', compact('banks', 'centers', 'cities', 'states', 'training_fields'));
    }
    public function store(Request $request){
       // return $request->all();
        $address = Address::create($request->all());
        if($address){
            $request['address_id'] = $address->id;
            $instructor = Instructor::create($request->all());
            if($instructor){
                $type = $instructor->evaluador ? ('Ev-') : ('In-');
                $instructor->key = $type . str_pad($instructor->id, 4, '0', STR_PAD_LEFT);
                if($request->hasFile('avatar_path')){
                    $file = $request->file('avatar_path');
                    $name_file = $instructor->id . "_instructor" . "." . $file->getClientOriginalExtension();
                    $path = $request->file('avatar_path')->storeAs(
                        'public/instructor/covers', $name_file
                    );
                    $instructor->avatar_path = $name_file;
                }
                $instructor->save();
                $instructor->training_fields()->sync($request->training_fields);
                return redirect()->route('instructor.index')->with('success', 'Proceso realizado correctamente');
            }
        }
        return redirect()->back()->with('error', 'no se pudo agregar');
    }
    public function show($id){
        $instructor = Instructor::find($id);
        $instructor->load('address.city.state', 'bank',
        'groups.course:id,name',
        'groups.place:id,name', 
        'courses:id,key,name,type_course,modality_course', 'training_fields');
    #  return $instructor; 
        return view('admin.instructors.detail', compact('instructor'));
    }
    public function get($id){
        $instructor = Instructor::with('address.city.state', 'center')->get()->find($id);
        return response()->json([
            'message' => 'Registro consultado correctamente',
            'data' => $instructor
        ],200);
    }
    public function edit($id){
        $cities = City::all();
        $states = State::all();
        $centers = Center::all();
        $banks = Bank::orderBy('marca')->get();
        $training_fields = TrainingField::all();
        $instructor = Instructor::with('address.city.state', 'center', 'training_fields')->get()->find($id);
        return view('admin.instructors.edit', compact('cities', 'states', 'centers', 'banks', 'instructor', 'training_fields'));
    }
    public function update(InstructorRequest $request, Instructor $instructor){
        //$instructor = Instructor::where('id', $request->id)->first();
        if ($instructor->update($request->except(['avatar_path']))) {
            if($instructor->avatar_path != "cover.jpg" && $request->avatar_path != "cover.jpg"){
                $path = storage_path() . "/app/public/instructor/covers/".$instructor->avatar_path;

                //borrar imagen
                if (File::exists($path)) {

                    File::delete($path);

                    $instructor->avatar_path = 'cover.jpg';
                }
            }
            //guardar cover
            if($request->hasFile('avatar_path')){
                
                $file = $request->file('avatar_path');
                $name_file = $instructor->id."_instructor".".".$file->getClientOriginalExtension();

                $path = $request->file('avatar_path')->storeAs(
                    'public/instructor/covers/', $name_file
                );
                $instructor->avatar_path = $name_file;
            }
            //actualizar si se hizo evaluador o si sigue siendo instructor
            $type = $instructor->evaluador ? ('Ev-') : ('In-');
            $instructor->key = $type . str_pad($instructor->id, 4, '0', STR_PAD_LEFT);
            if($instructor->address != null){
                $instructor->address->fill($request->all());
                $instructor->push();
            }
            $instructor->training_fields()->sync($request->training_fields);
            $instructor->save();
            return redirect()->route('instructor.index')->with('success', 'Proceso realizado correctamente');
        }
        return redirect()->back()->with('error', 'no se actualizo');
    }
    public function destroy($id){
        $instructor = Instructor::find($id);
        if ($instructor) {
            $instructor->delete();
        }
        return redirect()->back()->with('success', 'ok');
    }
}
