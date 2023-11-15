<?php

namespace App\Exports;

use App\Models\Group;
use App\Models\Place;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPlaceGroups implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    private $id;

    /**
     * Constructor
     *
     * @param  int  $id Place id to export
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Group::where('place_id', $this->id)->with(
            'center',
            'course',
            'instructor'
        );
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $place = Place::find($this->id);

        return [
            ['GRUPOS: '.$place->name],
            [],
            ['Identificador', 'Grupo', 'Curso', 'Instructor', 'Centro', 'Fecha de inicio', 'Fecha de fin', 'Hora de inicio', 'Hora de fin'],
        ];
    }

    /**
     * @param  Group  $row
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->key,
            $row->course->name,
            $row->instructor->name,
            $row->center->name,
            $row->date_start->format('d/m/Y'),
            $row->date_end->format('d/m/Y'),
            $row->time_start,
            $row->time_end,
        ];
    }
}
