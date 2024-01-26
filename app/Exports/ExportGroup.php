<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable as Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportGroup implements FromCollection, WithMapping, ShouldAutoSize, WithCustomStartCell, WithHeadings, WithDrawings
{
    use Exportable;

    protected $groups;

    public function __construct($groups)
    {
        $this->groups = $groups;
    }

    public function collection()
    {
        return $this->groups;
    }

    public function map($row): array
    {
        $row = collect($row)->map(function ($row) {
            return collect($row);
        });

        $students = '';
        foreach ($row->get('students') as $student) {
            $students .= $student['curp'].',';
        }

        $days = '';
        foreach ($row->get('days') as $day) {
            $days .= $day['name'].',';
        }

        return [
            // ref. esto ?
            $row->get('key')->get(0),
            $row->get('place')->get('name'),
            $row->get('instructor')->get('name'),
            $row->get('course')->get('name'),
            $students,
            $days,
            $row->get('place')->get('center')['name'],
            $row->get('date_start')->get(0),
            $row->get('date_end')->get(0),
            $row->get('time_start')->get(0),
            $row->get('time_end')->get(0),
        ];
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function headings(): array
    {
        return [
            'CLAVE',
            'LUGAR',
            'INSTRUCTOR',
            'CURSO',
            'ESTUDIANTES',
            'DIAS',
            'CENTRO',
            'FECHA INICIO',
            'FECHA FINAL',
            'HORA DE INICIO',
            'HORA FINAL',
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('logo icatebcs');
        $drawing->setPath(public_path('images/ICATEBCS-favicon.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
