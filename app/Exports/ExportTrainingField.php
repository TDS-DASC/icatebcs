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


class ExportTrainingField implements FromCollection, WithMapping, WithHeadings, WithDrawings, WithCustomStartCell
, ShouldAutoSize, WithStyles
{
    public function __construct($training_fields)
    {
        $this->training_fields = $training_fields;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->training_fields;
    }

    public function map($training_field):array{
        return [
            $training_field->id,
            $training_field->key,
            $training_field->name,
            $training_field->status = ($training_field->status == 1) ? 'Activo' : 'No disponible',
            $training_field->type
        ];
    }

    public function headings():array{
        return [
            '#',
            'Codigo',
            'Nombre',
            'Estado',
            'Tipo'
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
