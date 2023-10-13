<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'type_course' => 'required',
            'duration_course' => 'required',
            'modality_course' => 'required',
            'constancy_type' => 'required',
            'training_field_id' => 'required',
            'description' => 'required'
        ];
        
    }
    public function attributes(){
        return [
            'name' => 'nombre',
            'type_course' => 'tipo del curso',
            'duration_course' => 'duracion del curso',
            'modality_course' => 'modalidad del curso',
            'constancy_type' => 'tipo de constancia',
            'training_field_id' => 'campo de formación',
            'description' => 'descripción'
        ];
    }
}
