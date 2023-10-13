<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class ExportInstructor implements FromCollection, WithMapping, WithHeadings, WithDrawings, WithCustomStartCell
, ShouldAutoSize, WithStyles

{

    public function __construct($instructors){
        $this->instructors = $instructors;
        $this->grades = [
            '1' => 'PREESCOLAR',
            '2' => 'PRIMARIA',
            '3' => 'SECUNDARIA',
            '4' => 'PREPARATORIA / BARCHILLERATO',
            '5' => 'LICENCIATURA / INGENIERIA',
            '6' => 'MAESTRIA / DOCTORADO',
       
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->instructors;
    }

    public function headings():Array{
        return [
            '#',
            'Clave',
         //   'Avatar_path',
            'Evaluador',
            'Nombre (s)',
            'Apellido paterno',
            'Apellido materno',
            'CURP',
            'RFC',
            'Lugar de nacimiento',
            'Fecha de nacimiento',
            'Estado civil',
            'email',
            'Celular',
            'Telefono',


            'Curriculum',
            'Curriculum Vitae',
            'Estado de cuenta',
            'Ultimo grado concluido',
            'Alineacion 217',
            'Alineacion 301',

            'Estandar EC0038',
            'Estandar EC0128',
            'Estandar EC0076',
            'Estandar EC0249',
            'Estandar EC0305',
            'Estandar EC0105',
            'Estandar EC0127',
            'Estandar EC0435',
            'Estandar EC0081',
            'Otro estandar',

            'Comprobante de estudios',
            'Comprobante de estado de cuenta',
            'Ultumo grado adquirido',
            'Certificaciones propias',
            
            'Documento RFC',
            'Documento Direccion',
            'Documento CURP',
            'Documento INE',
            'Documento certificado medico',
            'Documento cuenta bancaria',
            'Fecha de entrada',
            'Fecha de suspension',
            'Obsevaciones',
            'Banco',
            'Clave interbancaria',
            'Cuenta bancaria',
            'Centro',
            'Colonia',
            'Calle',
            'Codigo Postal',
            'Numero',
            'Ciudad',
        ];
    }

    public function map($instructor):array{
        // dd($instructor);
        return [
            $instructor->id,
            $instructor->key ?? 'No disponible',
            $instructor->evaluador == 1 ? 'SI' : 'NO',
            $instructor->name,
            $instructor->first_name,
            $instructor->last_name,
            $instructor->curp,
            $instructor->rfc,
            $instructor->birth_place,
            $instructor->birthdate,
            $instructor->marital_status,
            $instructor->email,
            $instructor->phone_number ?? 'No disponible',
            $instructor->telephone_number ?? 'No disponible',


            $instructor->curriculum == '1' ? 'SI' : 'NO',
            $instructor->curriculum_vitae == '1' ? 'SI' : 'NO',
            $instructor->account_status == '1' ? 'SI' : 'NO',
            $instructor->last_grade =  array_key_exists($instructor->last_grade, $this->grades) ? $this->grades[$instructor->last_grade] : "No disponible",
            $instructor->alineacion_217 == '1' ? 'SI' : 'NO',
            $instructor->alineacion_301  == '1' ? 'SI' : 'NO',

            $instructor->standard_ec0038 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0128 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0076 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0249 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0305 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0105 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0127 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0435 == '1' ? 'SI' : 'NO',
            $instructor->standard_ec0081 == '1' ? 'SI' : 'NO',
            $instructor->other_standard,

            $instructor->document_study  == '1' ? 'SI' : 'NO',
            $instructor->document_account_status  == '1' ? 'SI' : 'NO',
            $instructor->acquired_grade,
            $instructor->own_certifications == '1' ? 'SI' : 'NO',
    

            $instructor->document_rfc == '1' ? 'SI' : 'NO',
            $instructor->document_address == 1 ? 'SI' : 'NO',
            $instructor->document_curp == '1' ? 'SI' : 'NO',
            $instructor->document_official_ine == '1' ? 'SI' : 'NO',
            $instructor->document_certificate_medical == 1 ? 'SI' : 'NO',
            $instructor->document_bank_account == '1' ? 'SI' : 'NO',
            $instructor->admission_date ?? 'No disponible',
            $instructor->suspension_date ?? 'No disponible',
            $instructor->observations ?? 'No disponible',
            $instructor->bank = $instructor->bank->marca,
            $instructor->interbank_key,
            $instructor->bank_account,
            $instructor->center = $instructor->center->name,
            $instructor->colonia = $instructor->address->colonia,
            $instructor->calle = $instructor->address->calle,
            $instructor->codigo_postal = $instructor->address->codigo_postal,
            $instructor->numero = $instructor->address->numero,
            $instructor->ciudad = $instructor->address->city->name
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function drawings(){
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('logo icatebcs');
        $drawing->setPath(public_path('images/ICATEBCS-favicon.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function startCell(): string
    {
        return 'A8';
    }

    


}
