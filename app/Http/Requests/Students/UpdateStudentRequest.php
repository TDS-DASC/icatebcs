<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
        return [
            'name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'birthdate' => 'required',
//            'birth_place' => 'required',
            'gender' => 'required',
            'curp' => 'required|unique:students,curp,' . $this->student->id,
            'center_id' => 'required',
            'marital_status' => 'required',
            'job_condition' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
//            'disability_visual' => 'required',
//            'disability_hearing' => 'required',
//            'disability_intellectual' => 'required',
//            'disability_communication' => 'required',
//            'group_adolescentes' => 'required',
//            'group_jefamilia' => 'required',
//            'group_indigenas' => 'required',
//            'group_cereso' => 'required',
//            'group_terceraedad' => 'required',
//            'group_migrantes' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
    public function message()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El valor del campo :attribute ya está en uso.'
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
            'center_id' => 'centro',
            'academic_level' => 'grado académico',
            'marital_status' => 'estado civil',
            'job_condition' => 'estado laboral',
            'colonia' => 'colonia',
            'calle' => 'calle',
            'codigo_postal' => 'código postal',
            'numero' => 'numero',
            'state_id' => 'estado',
            'city_id' => 'ciudad',
//            'disability_visual' => '',
//            'disability_hearing' => '',
//            'disability_intellectual' => '',
//            'disability_communication' => '',
//            'group_adolescentes' => '',
//            'group_jefamilia' => '',
//            'group_indigenas' => '',
//            'group_cereso' => '',
//            'group_terceraedad' => '',
//            'group_migrantes' => ''
        ];
    }
}
