<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $rules =  [
            // 'name' => 'required',
            'center_id' => 'required|exists:centers,id',
            'course_id' => 'required|exists:courses,id',
            'place_id' => 'required|exists:places,id',
            'instructor_id' => 'required|exists:instructors,id',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'student_ids*' => 'exists|students:id',
            // 'day_ids*' => 'exists|days:id'
            /* 
            'price_instructor' => 'required',
            'price_student' => 'required',
            'min_students' => 'required|min:1',
            'max_students' => 'required',
            'status' => 'required', */
        ];
        return $rules;
    }
}
