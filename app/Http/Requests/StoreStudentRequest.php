<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $stud = $this->student;
        $rules =[
            'name' => 'required',
            'center_id'  => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'academic_level' => 'required',
            'marital_status' => 'required',
            'job_condition' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            //'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required'
        ];
        if(!$stud){
            $rules['curp'] = 'required|unique:students,curp';
            $rules['email'] = 'unique:students,email';
        }else{
            $rules['curp'] = 'required|unique:students,curp,'.$this->student->id;
            $rules['email'] = 'unique:students,email,'.$this->student->id;
        }
        return $rules;
    }
    public function messages(){
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El valor del campo :attribute ya está en uso.',
        ];
    }
    public function attributes(){
        return [
            'name' => 'nombre',
            'center_id'  => 'centro', 
            'first_name' => 'apellido paterno',
            'last_name' => 'apellido materno',
            'curp' => 'CURP',
            'birthdate' => 'fecha de nacimiento',
            'gender' => 'género',
            'email' => 'email',
            'birth_place' => 'lugar de nacimiento',
            'academic_level' => 'grado académico',
            'marital_status' => 'estado civil',
            'job_condition' => 'estado laboral',
            'colonia' => 'colonia',
            'calle' => 'calle',
            'codigo_postal' => 'código postal',
            'numero' => 'numero',
            'state_id' => 'estado',
            'city_id' => 'ciudad',
        ];
    }
}
