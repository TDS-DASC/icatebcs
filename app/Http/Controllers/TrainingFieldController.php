<?php

namespace App\Http\Controllers;

use App\Models\TrainingField;
use Illuminate\Http\Request;

class TrainingFieldController extends Controller
{
    public function index(){
        $trainingFields = TrainingField::with('courses')->get();

        foreach($trainingFields as $tf){
            $tf->course_amount = $tf->courses->count();
           unset($tf->courses);
        }
       // return  $trainingFields;

      return view('admin.training_fields.index', compact('trainingFields'));
    }
    public function create(){
        $trainingFields = TrainingField::all();
        return view('admin.training_fields.create', compact('trainingFields'));

    }
    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'type' => 'required',
        ];
        $request->validate($rules);
        $trainingField = TrainingField::create($request->all());
        if($trainingField){

            $trainingField->key = date("y") . str_pad($trainingField->id, 3, '0', STR_PAD_LEFT);
            $trainingField->save();
            return redirect()->back()->with('success', 'Se creo el campo de formación');
        }
        return redirect()->back()->with('error', 'no se pudo guardar el campo');
        //return $trainingField;
    }
    public function show($id){
        $trainingField = TrainingField::with('courses')->get()->find($id);
        return view('admin.training_fields.detail', compact('trainingField'));
    }
    public function get($id){
        $trainingField = TrainingField::with('courses')->get()->find($id);
        return response()->json([
            'message' => 'Consulta campo de formacion',
            'data' => $trainingField
        ],200);

    }
    public function edit($id){
        $trainingField = TrainingField::find($id);
        return view('admin.training_fields.edit', compact('trainingField'));
    }
    public function update(Request $request){
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'type' => 'required',
        ];
        $request->validate($rules);
        $trainingField = TrainingField::find($request->id);
        if ($trainingField){
            $trainingField->update($request->all());
            return redirect()->back()->with('success', 'Se actualizó el campo de formación');
        }
        return redirect()->back()->with('error', 'no se pudo actualizar el campo de formacion');
    }
    public function destroy($id){
        $trainingField = TrainingField::find($id);
        if ($trainingField){
            $trainingField->delete();
            return redirect()->back()->with('success', 'Se eliminó el campo de formación');
        }
        return redirect()->back()->with('error', 'no se pudo borrar el campo de formacion');
    }
}
