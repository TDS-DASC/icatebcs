<?php

namespace App\Http\Requests\Students;

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
            'first_name' => 'required',
            'last_name' => 'required',
            'birthdate' => 'required',
            'birth_place' => 'required',
            'gender' => 'required',
            'center_id'  => 'required',
            'marital_status' => 'required',
            'job_condition' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'state_id' => 'required',
            'city_id' => 'required'
        ];
        if(!$stud){
            $rules['curp'] = 'required|unique:students,curp';
            $rules['email'] = 'nullable|unique:students,email';
        }else{
            $rules['curp'] = 'required|unique:students,curp,'.$this->student->id;
            $rules['email'] = 'nullable|unique:students,email,'.$this->student->id;
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El valor del campo :attribute ya está en uso.',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'first_name' => 'apellido paterno',
            'last_name' => 'apellido materno',
            'birthdate' => 'fecha de nacimiento',
            'birth_place' => 'lugar de nacimiento',
            'gender' => 'género',
            'curp' => 'CURP',
            'email' => 'email',
            'center_id'  => 'centro',
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
