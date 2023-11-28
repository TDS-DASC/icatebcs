<?php

namespace App\Http\Requests\Instructors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructorRequest extends FormRequest
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
            'center_id'  => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'curp' => 'required|unique:instructors,curp,'. $this->instructor->id,
            'rfc' => 'required|unique:instructors,rfc,'. $this->instructor->id,
            'email' => 'required|unique:instructors,email,'. $this->instructor->id,
            'birthdate' => 'required',
            'birth_place' => 'required',
            'marital_status' => 'required',
            'evaluador' => 'required',
            'bank_id' => 'required',
            'interbank_key' => 'required',
            'bank_account' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'codigo_postal' => 'required',
            'numero' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
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
            'unique' => 'El valor del campo :attribute ya está en uso.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'center_id' => 'centro',
            'first_name' => 'apellido paterno',
            'last_name' => 'apellido materno',
            'curp' => 'CURP',
            'rfc' => 'RFC',
            'birthdate' => 'fecha de nacimiento',
            'birth_place' => 'lugar de nacimiento',
            'marital_status' => 'estado civil',
            'email' => 'correo electrónico',
            'gender' => 'género',
            'academic_level' => 'grado académico',
            'job_condition' => 'estado laboral',
            'interbank_key' => 'clabe interbancaria',
            'bank_account' => 'cuenta de banco',
            'colonia' => 'colonia',
            'calle' => 'calle',
            'codigo_postal' => 'código postal',
            'numero' => 'numero',
            'state_id' => 'estado',
            'city_id' => 'ciudad',
        ];
    }
}
