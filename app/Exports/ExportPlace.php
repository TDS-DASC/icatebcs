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
use App\Models\Place;
class ExportPlace implements FromCollection, WithMapping, WithHeadings, WithDrawings, WithCustomStartCell
, ShouldAutoSize, WithStyles{

    public function __construct($places)
    {
        $this->places = $places;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->places;
    }

    public function headings():array{
        return [
            '#',
            'Nombre',
            'Clave',
            'Telefono',
          //  'Imgen',
            'Colonia',
            'Calle',
            'Codigo Postal',
            'Numero',
            'Ciudad',
            'Centro',
            'Localidad'
        ];
    } 

    public function map($place):array{
        return [
            $place->id ?? 'No disponible',
            $place->name,
            $place->key ?? 'No disponible',
            $place->phone_number ?? 'No disponible',
          //  $place->cover_path,
            $place->colonia = $place->address->colonia ?? 'No disponible', 
            $place->calle = $place->address->calle ?? 'No disponible',
            $place->codigo_postal = $place->address->codigo_postal ?? 'No disponible',
            $place->numero = $place->address->number ?? 'No disponible',
            $place->city = $place->address->city->name ?? 'No disponible',
            $place->center = $place->center->name ?? 'No disponible' ,
            $place->locality ?? 'No disponible'
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
