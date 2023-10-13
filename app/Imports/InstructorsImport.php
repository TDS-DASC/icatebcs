<?php

namespace App\Imports;

use App\Helpers\AppHelpers;
use App\Models\Address;
use App\Models\Bank;
use App\Models\Center;
use App\Models\Instructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\City;
use App\Models\State;
use Error;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
// HeadingRowFormatter::default('none');
class InstructorsImport implements ToModel, WithStartRow, WithValidation, SkipsOnError, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;

 
    use Importable;
    public $new_records = 0;


    private $grades = [
        '1' => 'PREESCOLAR',
        '2' => 'PRIMARIA' ,
        '3' => 'SECUNDARIA',
        '4' => 'PREPARATORIA / BARCHILLERATO',
        '5' => 'LICENCIATURA / INGENIERIA',
        '6' => 'MAESTRIA / DOCTORADO' ,
    ];
    public function model(array $row){
        //dd($row);
    
        $address = new Address;
        $address->colonia = $row['colonia'];// 36
        $address->calle = $row['calle']; // 37
        $address->codigo_postal = $row['codigo_postal']; // 38
        $address->numero = $row['numero']; // 'numero'
        $address->city_id = (integer) City::where('name', $row['ciudad'])->pluck('id')[0]; // 40  
        $address->save();

        $instructor = new Instructor([
            
            'key' => $row['clave'],
            'evaluador' => $row['evaluador'] == 'SI' ? '1' : '0',
            'name' => $row['nombre_s'],
            'first_name' => $row['apellido_paterno'],
            'last_name' => $row['apellido_materno'],
            'curp' => $row['curp'],
            'rfc' => $row['rfc'] ?? 0,
            'birth_place' => (integer) State::where('name', $row['lugar_de_nacimiento'])->pluck('id')[0],
            'birthdate' => $row['fecha_de_nacimiento'],
            'marital_status' => $row['estado_civil'],
            'email' => $row['email'] ?? 'No',
            'phone_number' => $row['celular'],
            'telephone_number' => $row['telefono'],


            'curriculum' => $row['curriculum'] =='SI'? '1':'2',
            'curriculum_vitae' => $row['curriculum_vitae'] == 'SI' ? '1':'0',
            'account_status' => $row['estado_de_cuenta'] =='SI'? '1':'0',

            'last_grade' => in_array($row['ultimo_grado_concluido'], $this->grades) ? array_search($row['ultimo_grado_concluido'], $this->grades): '0',

            'standard_ec0038' => $row['estandar_ec0038'] =='SI'? '1':'0',
            'standard_ec0128' => $row['estandar_ec0128'] =='SI'? '1':'0',
            'standard_ec0076' => $row['estandar_ec0076'] =='SI'? '1':'0',
            'standard_ec0249' => $row['estandar_ec0249'] =='SI'? '1':'0',
            'standard_ec0305' => $row['estandar_ec0305'] =='SI'? '1':'0',
            'standard_ec0105' => $row['estandar_ec0105'] =='SI'? '1':'0',
            'standard_ec0127' => $row['estandar_ec0127'] =='SI'? '1':'0',
            'standard_ec0435' => $row['estandar_ec0435'] =='SI'? '1':'0',
            'standard_ec0081' => $row['estandar_ec0081'] =='SI'? '1':'0',
            'other_standard' => $row['otro_estandar'] =='SI'? '1':'0',
           
            'alineacion_217' => $row['alineacion_217'] =='SI'? '1':'2',
            'alineacion_301' => $row['alineacion_301'] =='SI'? '1':'0',
            'document_study' => $row['comprobante_de_estudios'] =='SI'? '1':'2',
            'document_account_status' => $row['comprobante_de_estado_de_cuenta'] =='SI'? '1':'0',
            'acquired_grade' => $row['ultumo_grado_adquirido'],
            'own_certifications' => $row['certificaciones_propias'] =='SI'? '1':'0', 
        

            'document_rfc' => $row['documento_rfc']=='SI'? '1':'0',
            'document_address' => $row['documento_direccion'] =='SI'? '1':'0', 
            'document_curp' => $row['documento_curp'] =='SI'? '1':'0',
            'document_official_ine' => $row['documento_ine']=='SI'? '1':'0', 
            'document_certificate_medical' => $row['documento_certificado_medico'] =='SI'? '1':'0', 
            'document_bank_account' => $row['documento_cuenta_bancaria'] =='SI'? '1':'0', 
            'admission_date' =>  $row['fecha_de_entrada'] == 'No disponible'? null : $row['fecha_de_entrada'], 
            'suspension_date' => $row['fecha_de_suspension']  == 'No disponible'? null : $row['fecha_de_suspension'],
            'observations' => $row['obsevaciones'], 
            'bank_id' => (integer) Bank::where('marca', $row['banco'])->pluck('id')[0],
            'interbank_key' => $row['clave_interbancaria'] ?? '0',  
            'bank_account' => $row['cuenta_bancaria'] ?? '0', 
            'address_id' => $address->id, 
            'center_id' => Center::where('name', $row['centro'])->pluck('id')[0],
        ]);
        if($instructor){
            $this->new_records++;
            return $instructor;
        }
        Address::latest()->delete(); // borramos la direccion creada si no se creó correctamente el instructor
    }

    public function startRow(): int
    {
        return 9;
    }

    public function rules():array{
        //   return [];
         return [
            'ciudad' => 'required|exists:cities,name',
            'banco' => 'required|exists:banks,marca',
            'centro' => 'required|exists:centers,name',
            'lugar_de_nacimiento' => 'required|exists:states,name',

            //unicos
            'curp' => 'required|unique:instructors,curp',
            'rfc' => 'required|unique:instructors,rfc',

        
            'evaluador' => 'required', // evaluador
            'nombre_s' => 'required', // name
            'apellido_paterno' => 'required', // first name 
            'apellido_materno' => 'required', // last name 
  
            'fecha_de_nacimiento' => 'required',// birth date
            'estado_civil' => 'required',// marital status
            'email' => 'required|unique:instructors,email',// email
            // '12' => 'required',// phone number
            // 'telefono' => 'required',// telephone number
            'clave_interbancaria' => 'required', // clabe interbancaria
            'cuenta_bancaria' => 'required', // cuenta bancaria
 
            // direccion 
            'colonia' => 'required', // colonia
            'calle' => 'required', // calle
            'codigo_postal' => 'required', // codigo postal
            'numero' => 'required', // numero
        
        ];
    }

    public function customValidationMessages():array{
        return [
            'ciudad.exists' => "La :attribute no es valida",
            'banco.exists' => "La :attribute no es valido",
            'centro.exists' => "La :attribute no es valido",
            
            'curp.unique' => "El :attribute no es valido",
            'curp.required' => "El :attribute es un campo obligatorio",
            'rfc.unique' => "El :attribute no es valido",
            'rfc.required' => "El :attribute es un campo obligatorio",

            'evaluador.required' => "El :attribute es un campo obligatorio",
            'nombre_s.required' => "El :attribute es un campo obligatorio",
            'apellido_paterno.required' => "El :attribute es un campo obligatorio",
            'apellido_materno.required' => "El :attribute es un campo obligatorio",
            'lugar_de_nacimiento.required' => "El :attribute es un campo obligatorio",
            
            'fecha_de_nacimiento.required' => "El :attribute es un campo obligatorio",
            'email.required' => "El :attribute es un campo obligatorio",
            'email.unique' => "El :attribute debe ser un valor unico",
            'clave_interbancaria.required' => "El :attribute es un campo obligatorio",
            'cuenta_bancaria.required' => "El :attribute es un campo obligatorio",
            'colonia.required' => "El :attribute es un campo obligatorio",
            'calle.required' => "El :attribute es un campo obligatorio",
            'codigo_postal.required' => "El :attribute es un campo obligatorio",
            'numero.required' => "El :attribute es un campo obligatorio",
        ];
    }
    
    public function customValidationAttributes():array{
        return [
            'curp'  => 'CURP',
            'rfc'  => 'RFC',
            'lugar_de_nacimiento' => 'Estado',
            'ciudad' => 'Ciudad', 
            'banco' => 'Banco',
            'centro' => 'Centro', 

            'evaluador' => 'Evaluador',
            'nombre_s' => 'Nombre', 
            'apellido_paterno' => 'Primer apellido', 
            'apellido_materno' => 'Segundo apellido', 
    
            'fecha_de_nacimiento' => 'Fecha de nacimiento',
            'estado_civil' => 'Estado civil',
            'email' => 'Correo electronico',
            'clave_interbancaria' => 'Clabe interbancaria', 
            'cuenta_bancaria' => 'Cuenta bancaria',


            'colonia' => 'Colonia', 
            'calle' => 'Calle',
            'codigo_postal' => 'Codigo postal', 
            'numero' => 'Numero',
           
        ];
    }

    public function headingRow():int{
        return 8;
    }
}