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

class ExportStudent implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithDrawings,
WithCustomStartCell
{
    public $students;
    public function __construct($students)
    {
        $this->students = $students;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->students;
    }


    public function headings():array{
        return [
            '#',
            'No.control',
            'Centro',
            'Cover',
            'Nombre',
            'Apellido paterno',
            'Apellido materno',
            'CURP',
            'Fecha de nacimiento',
            'Genero',
            'Correo Electronico',
            'Celular',
            'Telefono',
            'Facebook',
            'Twitter',
            'Lugar de nacimiento',
            'Nivel academico',
            'Grado Adquirido',
            'Estado civil',
            'Discapacidad visual',
            'Discapacidad motora',
            'Discapacidad auditiva',
            'Discapacidad intelectual',
            'Discapacidad de comunicacion',
            'Grupo Adolescente',
            'Grupo Jefe de Familia',
            'Grupo indigena',
            'Grupo cereso',
            'Grupo Tercera Edad',
            'Grupo Migrantes',
            'Condicion laboral',
            'Empresa',
            'Antiguedad',
            'Cargo',
            'Direccion de empresa',
            'Telefono de trabajo',
          /*  'Documento Estudio',
            'Documento nacimiento',
            'Documento Domicilio',
            'Documento CURP',
            'Documento Fotos',
            'Documento INE',
            'Documento Extranjero',
            */
            'Documento INE',
            'Documento Pasaporte',
            'Documento CURP',
            'Documento FMM2 o FMM3',
            'Documento Carta Responsiva',
      
            'Calle',
            'Colonia',
            'Codigo Postal',
            'Numero',
            'Ciudad'
        ];
    }

  public function map($member):array{
        return[
            $member->id,
            $member->no_control,
            $member->center->name,
            $member->avatar_path,
            $member->name,
            $member->first_name,
            $member->last_name,
            $member->curp,
            $member->birthdate,
            $member->gender,
            $member->email,
            $member->phone_number,
            $member->telephone_number ,
            $member->facebook ?? "No disponible",
            $member->twitter ?? "No disponible",
            $member->birth_place, // mostrar nombre
            $member->academic_level,
            $member->acquired_grade,
            $member->marital_status,
            $member->disability_visual ? 'SI' : 'NO',
            $member->disability_motor ? 'SI' : 'NO',
            $member->disability_hearing ? 'SI' : 'NO',
            $member->disability_intellectual ? 'SI' : 'NO',
            $member->disability_communication ? 'SI' : 'NO',
            $member->group_adolescente  ? 'SI' : 'NO',
            $member->group_jefamilia ? 'SI' : 'NO',
            $member->group_indigenas ? 'SI' : 'NO',
            $member->group_cereso ? 'SI' : 'NO',
            $member->group_terceraedad  ? 'SI' : 'NO',
            $member->group_migrantes ? 'SI' : 'NO',
            $member->job_condition,
            $member->job_company,
            $member->years_worked,
            $member->job_position,
            $member->address_job,
            $member->job_phone_number,
            /*$member->document_study ? 'SI' : 'NO',
            $member->document_birth ? 'SI' : 'NO',
            $member->document_address ? 'SI' : 'NO',
            $member->document_curp ? 'SI' : 'NO',
            $member->document_photos ? 'SI' : 'NO',
            $member->document_official_ine ? 'SI' : 'NO',
            $member->document_foreign ? 'SI' : 'NO', */

            $member->document_official_ine ? 'SI' : 'NO',
            $member->document_passport ? 'SI' : 'NO',
            $member->document_curp ? 'SI' : 'NO',
            $member->document_fmm2_fmm3 ? 'SI' : 'NO',
            $member->document_responsive_card ? 'SI' : 'NO',

            $member->calle = $member->address->calle,
            $member->colonia = $member->address->colonia,
            $member->codigo_postal = $member->address->codigo_postal,
            $member->numero = $member->address->numero,
           $member->ciudad = $member->address->city->name
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
