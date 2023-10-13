<?php

namespace App\Imports;

use App\Helpers\AppHelpers;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Address;
use App\Models\Center;
use App\Models\Student;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;


class StudentsImport implements WithStartRow, ToModel, SkipsOnError, SkipsOnFailure, WithValidation
, WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

//No.control

    public $new_records = 0;

    public function rules():array{
    //   return [ ];
        return [
            // validaciones del del store student
            'nombre'=> 'required', //  name
            'apellido_paterno' => 'required', //  first name
            'apellido_materno' => 'required', //  last name
            'fecha_de_nacimiento' => 'required', //  birth date 
            'genero' => 'required', //  gender 
            // '' => 'required', //  birth place
            'nivel_academico' => 'required', //  academic level
            'estado_civil' => 'required', //  marital status
            'condicion_laboral' => 'required', //  job condition
            // address 
            'calle' => 'required', //  calle
            'colonia' => 'required', //  colonia
            'codigo_postal' => 'required', //  codigo postal 
            // '15' => 'required', //  state_id
            // '10' => 'required', //  city_id

            /// validaciones para que no truene 
            'nocontrol' => 'required|unique:students,no_control', // numero de control
            'centro' => 'required|exists:centers,name', /// centro 
            'curp' => 'required|unique:students,curp', // curp
            'lugar_de_nacimiento' => 'exists:states,name' // estado
        ]; 
    } 

   public function model(array $row){
        $address = new Address;
        $address->calle  = $row['calle'];
        $address->colonia = $row['colonia'];
        $address->codigo_postal = $row['codigo_postal'];
        $address->numero = $row['numero'];
        $address->city_id = (integer) City::where('name', $row['ciudad'])->pluck('id')[0];  
        $address->save();

           $student =  new Student([
                'no_control' => $row['nocontrol'],
                'center_id' => Center::where('name', $row['centro'])->pluck('id')[0],
                // 'cover' => $row[3],
                'name' => $row['nombre'],
                'first_name' => $row['apellido_paterno'],
                'last_name' => $row['apellido_materno'],
                'curp' => $row['curp'],
                'birthdate' => $row['fecha_de_nacimiento'],
                'gender' => $row['genero'],
                'email' => $row['correo_electronico'],
                'phone_number' => $row['celular'],
                'telephone_number' => $row['telefono'],
                'facebook' => $row['facebook'],
                'twitter' => $row['twitter'],
                'birth_place' => State::where('name', $row['lugar_de_nacimiento'])->pluck('id')[0],
                'academic_level' => $row['nivel_academico'],
                'acquired_grade' => $row['grado_adquirido'],
                'marital_status' => $row['estado_civil'],
                'disability_visual' => ($row['discapacidad_visual'] == 'SI')? '1' : '0',
                'disability_motor' => ($row['discapacidad_motora']=='SI') ? '1' : '0',
                'disability_hearing' => ($row['discapacidad_auditiva'] == 'SI') ? '1' : '0',
                'disability_intellectual' =>  ($row['discapacidad_intelectual'] == 'SI') ? '1' : '0',
                'disability_comunication' => ($row['discapacidad_de_comunicacion'] == 'SI') ? '1' : '0',
                'group_adolescente' => ($row['grupo_adolescente'] == 'SI') ? '1' : '0',
                'group_jefamilia' => ($row['grupo_jefe_de_familia'] == 'SI') ? '1' : '0',
                'group_indigenas' => ($row['grupo_indigena'] == 'SI') ? '1' : '0',
                'group_cereso' => ($row['grupo_cereso'] == 'SI') ? '1' : '0',
                'group_terceraedad' => ($row['grupo_tercera_edad'] == 'SI')? '1' : '0',
                'group_migrantes' => ($row['grupo_migrantes'] == 'SI') ? '1': '0',
                'job_condition' => $row['condicion_laboral'],
                'job_company' => $row['empresa'],
                'years_worked' => $row['antiguedad'],
                'job_position' => $row['cargo'],
                'address_job' => $row['direccion_de_empresa'],
                'job_phone_number' => $row['telefono_de_trabajo'],
            /*  'document_study' => ($row['documento_estudio'] == 'SI') ? '1' : '0',
                'document_birth' => ($row['documento_nacimiento'] == 'SI') ? '1' : '0',
                'document_address' => ($row['documento_domicilio'] == 'SI') ? '1' : '0',
                'document_curp' => ($row['documento_curp'] == 'SI') ? '1' : '0',
                'document_photos' => ($row['documento_fotos'] == 'SI') ? '1' : '0',
                'document_official_ine' => ($row['documento_ine'] == 'SI') ? '1' : '0',
                'document_foreign' => ($row['documento_extranjero'] == 'SI') ? '1' : '0',
                */
                'document_official_ine' => $row['documento_ine'] == 'SI',
                'document_passport' => $row['documento_pasaporte'] == 'SI',
                'document_curp' => $row['documento_curp'] == 'SI',
                'document_fmm2_fmm3' => $row['documento_fmm2_o_fmm3'] == 'SI',
                'document_responsive_card' => $row['documento_carta_responsiva'] == 'SI',
                'address_id' => $address->id
            ]);

            if($student){
                      
                $this->new_records++;
                return $student;
            }
            Address::latest()->delete();
    }
    public function startRow():int{
        return 9;
    }

    public function customValidationMessages():array{
        return [
            'nombre.required' => ':attribute es un valor requerido',
            'apellido_paterno.required' => ':attribute es un valor requerido',
            'apellido_materno.required' => ':attribute es un valor requerido',
            'fecha_de_nacimiento.required' => ':attribute es un valor requerido',
            'genero.required' => ':attribute es un valor requerido',
            'nivel_academico.required' => ':attribute es un valor requerido',
            'estado_civil.required' => ':attribute es un valor requerido',
            'condicion_laboral.required' => ':attribute es un valor requerido',
            'calle.required' => ':attribute es un valor requerido',
            'colonia.required' => ':attribute es un valor requerido',
            'codigo_postal.required' => ':attribute es un valor requerido',
           
           
           
            'nocontrol.unique' => ':attribute debe ser un valo unico',
            'centro.exists' => 'Nombre del :attribute no coincide con nuestros registros', 
            'curp.unique' => ':attribute no es valido',
            'lugar_de_nacimiento.exists' => ':attribute no es un estado valido'

        ];
    }
    public function customValidationAttributes(){
      
        return 
        [
            'nombre'=> 'Nombre',
            'apellido_paterno' => 'Primer apellido', 
            'apellido_materno' => 'Segundo apellido',
            'fecha_de_nacimiento' => 'Fecha de nacimiento', 
            'genero' => 'genero',
            'nivel_academico' => 'Grado academico', 
            'estado_civil' => 'Estado civil', 
            'condicion_laboral' => 'Condicion laboral',
            

            // address 
            'calle' => 'Calle',
            'colonia' => 'Colonia', 
            'codigo_postal' => 'Codigo postal', 


            'nocontrol' => 'Numero de control',
            'centro' => 'Centro',
            'curp' => 'CURP',
          
            'lugar_de_nacimiento' => 'Lugar de nacimiento'
        ];
    }


    public function headingRow(): int{
        return 8;
    }
}
