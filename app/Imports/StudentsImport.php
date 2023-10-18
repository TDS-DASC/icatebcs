<?php

namespace App\Imports;

use App\Models\Address;
use App\Models\Center;
use App\Models\Student;
use App\Models\City;
use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements WithStartRow, ToModel, SkipsOnError, SkipsOnFailure, WithValidation, WithHeadingRow, SkipsEmptyRows, WithCalculatedFormulas
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $new_records = 0;

    public function headingRow(): int
    {
        return 8;
    }

    public function startRow(): int
    {
        return 9;
    }

    public function rules(): array
    {
        return [
            // TODO: ask customer which attributes are required
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'fecha_de_nacimiento' => 'required',
            'genero' => 'required',
            'nivel_academico' => 'required',
            'estado_civil' => 'required',
            'condicion_laboral' => 'required',
            'nocontrol' => 'required',
            'centro' => 'required|exists:centers,name',
            'curp' => 'required',
            'lugar_de_nacimiento' => 'exists:states,name'
            // segundo apellido
            // numero de celular
            // grado academico
            // grado adquirido
        ];
    }

    public function handle_student($student, array $row)
    {
        // TODO: check if address already exists and use it
        $address = new Address;
        $address->calle  = $row['calle'];
        $address->colonia = $row['colonia'];
        $address->codigo_postal = $row['codigo_postal'];
        $address->numero = $row['numero'];

        try {
            $address->city_id = (int) City::where('name', $row['ciudad'])->pluck('id')[0];
        } catch (\Exception $e) {
            $address->city_id = 1;
        } catch (\Throwable $e) {
            $address->city_id = 1;
        }

        $address->save();

        if (!$student) $student = new Student;

        $student->birth_place = State::where('name', $row['lugar_de_nacimiento'])->pluck('id')[0];
        try {
            $student->birth_place = State::where('name', $row['lugar_de_nacimiento'])->pluck('id')[0];
        } catch (\Exception $e) {
            //do something when exception is thrown
            $student->birth_place = null;
        } catch (\Throwable $e) {
            //do something when Throwable is thrown
            $student->birth_place = null;
        }

        $student->address_id = $address->id;
        $student->address_job = $row['direccion_de_empresa'];
        $student->academic_level = $row['nivel_academico'];
        $student->acquired_grade = $row['grado_adquirido'];
        $student->birthdate = $row['fecha_de_nacimiento'];
        $student->curp = $row['curp'];
        $student->center_id = Center::where('name', $row['centro'])->pluck('id')[0];
        $student->disability_intellectual = ($row['discapacidad_intelectual'] == 'SI') ? '1' : '0';
        $student->disability_hearing = ($row['discapacidad_auditiva'] == 'SI') ? '1' : '0';
        $student->disability_visual = ($row['discapacidad_visual'] == 'SI') ? '1' : '0';
        $student->document_official_ine = $row['documento_ine'] == 'SI';
        $student->document_passport = $row['documento_pasaporte'] == 'SI';
        $student->document_curp = $row['documento_curp'] == 'SI';
        $student->document_fmm2_fmm3 = $row['documento_fmm2_o_fmm3'] == 'SI';
        $student->document_responsive_card = $row['documento_carta_responsiva'] == 'SI';
        $student->disability_motor = ($row['discapacidad_motora'] == 'SI') ? '1' : '0';
        $student->email = $row['correo_electronico'];
        $student->first_name = $row['apellido_paterno'];
        $student->gender = $row['genero'];
        $student->group_cereso = ($row['grupo_cereso'] == 'SI') ? '1' : '0';
        $student->group_jefamilia = ($row['grupo_jefe_de_familia'] == 'SI') ? '1' : '0';
        $student->group_terceraedad = ($row['grupo_tercera_edad'] == 'SI') ? '1' : '0';
        $student->group_adolescente = ($row['grupo_adolescente'] == 'SI') ? '1' : '0';
        $student->group_migrantes = ($row['grupo_migrantes'] == 'SI') ? '1' : '0';
        $student->group_indigenas = ($row['grupo_indigena'] == 'SI') ? '1' : '0';
        $student->job_condition = $row['condicion_laboral'];
        $student->job_company = $row['empresa'];
        $student->job_position = $row['cargo'];
        $student->job_phone_number = $row['telefono_de_trabajo'];
        $student->last_name = $row['apellido_materno'];
        $student->marital_status = $row['estado_civil'];
        $student->name = $row['nombre'];
        $student->phone_number = $row['celular'];
        $student->telephone_number = $row['telefono'];
        $student->years_worked = $row['antiguedad'];
        $student->save();

        return $student;
    }

    public function model(array $row)
    {
        // Create student if not exists, otherwise update it
        $this->new_records++;
        $student = Student::where('no_control', $row['nocontrol'])->first();
        $new_student = $this->handle_student($student, $row);
        return $new_student;
    }

    public function customValidationMessages(): array
    {
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

    public function customValidationAttributes(): array
    {
        return [
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Primer apellido',
            'apellido_materno' => 'Segundo apellido',
            'fecha_de_nacimiento' => 'Fecha de nacimiento',
            'genero' => 'genero',
            'nivel_academico' => 'Grado academico',
            'estado_civil' => 'Estado civil',
            'condicion_laboral' => 'Condicion laboral',
            'calle' => 'Calle',
            'colonia' => 'Colonia',
            'codigo_postal' => 'Codigo postal',
            'nocontrol' => 'Numero de control',
            'centro' => 'Centro',
            'curp' => 'CURP',
            'lugar_de_nacimiento' => 'Lugar de nacimiento'
        ];
    }
}
