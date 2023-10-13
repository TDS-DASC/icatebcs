<?php

namespace App\Imports;



use App\Models\Center;
use App\Models\Instructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Group;
use App\Models\Place;
use App\Models\Student;
use App\Models\Course;
use App\Models\Day;
class GroupImport implements ToModel, WithValidation, SkipsOnError, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;

    public $new_records;

    public function __construct()
    {
        $this->new_records = collect();
    }

    public function model($row){

        $students = Student::select('id')->whereIn('curp', $row['estudiantes'])->get();
        $days = Day::select('id')->whereIn('name', $row['dias'])->get();

        $group = Group::create([
            'key' => $row['clave'],
            'course_id' => Course::where('name', $row['curso'])->pluck('id')[0],
            'place_id' => Place::where('name', $row['lugar'])->pluck('id')[0],
            'center_id' =>  Center::where('name', $row['centro'])->pluck('id')[0],
            'instructor_id' => Instructor::where('name', $row['instructor'])->pluck('id')[0],
            'date_start' => $row['fecha_inicio'],
            'date_end' => $row['fecha_final'],
            'time_start' => $row['hora_de_inicio'],
            'time_end' => $row['hora_final'],
        ]);
        
        $group->students()->sync($students, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $group->days()->sync($days,  [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $group->save();
     //   error_log(json_encode($days));
        $this->new_records->add($group->id);
        return $group;
    }

    public function headingRow(): int{
        return 8;
    }

    public function prepareForValidation($data, $index){
             
        $data['estudiantes'] = array_filter(explode(',',$data['estudiantes']));
        $data['estudiantes'] = array_map('trim', $data['estudiantes']);

     //  $data['estudiantes'][0] = 'asd';
        
        $data['dias'] = array_filter(explode(',', $data['dias']));
        $data['dias'] = array_map('trim', $data['dias']);
      
     //   $data['dias'][0] = 'sdad';

        error_log(json_encode($data['dias']));
        return $data;
    }

    public function rules():array{
     //  return [];
        return [
            'clave' => 'required|unique:groups,key',
            'estudiantes' => 'required|exists:students,curp',
            'dias'  => 'required|exists:days,name',
            'curso' => 'required|exists:courses,name',
            'lugar' => 'required|exists:places,name',
            'centro' => 'required|exists:centers,name',
            'instructor' => 'required|exists:instructors,name',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date',
           // 'hora_de_inicio' => 'required|date_format:H:i:s',
            'hora_final' => 'required',
            'hora_de_inicio' => 'required',
        ];
    }

    public function customValidationMessages(){

        return [
            'estudiantes.*' => 'Hay un error en los estudiantes. Revisa que los curps han sido registrados',
            'dias.*' => 'Error en los dias',
            'curso.*' => 'El curso no es válido',
            'lugar.*' => 'El lugar no es vàlido',
            'centro.*' => 'El centro no es vàlido',
            'instructor.*' => 'El instructor no es vàlido. Revisa que su curp haya sido registrado',
            'fecha_inicio.*' => 'La fecha de inicio no es vàlida',
            'fecha_final.*' => 'La fecha final no es vàlida',
            'hora_de_inicio.*' => 'La hora de inicio no es vàlida',
            'hora_final.*' => 'La hora de salida no es vàlida',

        ];
    }
}
