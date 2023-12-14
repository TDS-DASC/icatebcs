<?php

namespace App\Exports;

use App\Models\Instructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExportInstructorsReport implements WithEvents, WithHeadingRow
{
    private $calledByEvent;
    private $male_instructors;
    private $female_instructors;
    private $male_evaluators;
    private $female_evaluators;

    public function __construct()
    {
        $this->male_instructors = collect();
        $this->female_instructors = collect();
        $this->male_evaluators = collect();
        $this->female_evaluators = collect();

        Instructor::all()->each(function ($value, $key) {
            $is_evaluator = $value['evaluador'] == 1;
            $is_male = $value['curp'][10] != 'M';

            if ($is_evaluator) {
                $is_male ?
                    $this->male_evaluators->push($value) :
                    $this->female_evaluators->push($value);
            } else {
                $is_male ?
                    $this->male_instructors->push($value) :
                    $this->female_instructors->push($value);
            }
        });
    }
    public function registerEvents(): array
    {
        $male_instructors = $this->male_instructors;
        $female_instructors = $this->female_instructors;
        $male_evaluators = $this->male_evaluators;
        $female_evaluators = $this->female_evaluators;

        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $event->writer->reopen(
                    new LocalTemporaryFile(storage_path('app/public/plantilla_reporte_instructores.xlsx')),
                    Excel::XLSX);
                $event->writer->getSheetByIndex(0);

                $this->calledByEvent = true; // set the flag
                $event->writer->getSheetByIndex(0)->export($event->getConcernable());

                return $event->getWriter()->getSheetByIndex(0);
            },
            AfterSheet::class => function(AfterSheet $event) use (
                $male_instructors,
                $female_instructors,
                $male_evaluators,
                $female_evaluators
            ) {

                // Instructores --------------------------------------------

                // Preescolar completo
                $event->sheet->setCellValue(
                    'C12',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 1;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D12',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 1;
                    })->count()
                );

                // Primaria completa
                $event->sheet->setCellValue(
                    'C13',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 2;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D13',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 2;
                    })->count()
                );

                // Secundaria completa
                $event->sheet->setCellValue(
                    'C15',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 3;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D15',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 3;
                    })->count()
                );

                // Bachillerato completa
                $event->sheet->setCellValue(
                    'C19',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 4;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D19',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 4;
                    })->count()
                );

                // Licenciatura/Ingeniería completa
                $event->sheet->setCellValue(
                    'C21',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 5;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D21',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 5;
                    })->count()
                );

                // Posgrado completo
                $event->sheet->setCellValue(
                    'C22',
                    $male_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 6;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D22',
                    $female_instructors->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 6;
                    })->count()
                );

                // Evaluadores ----------------------------------------------

                // Preescolar completo
                $event->sheet->setCellValue(
                    'C34',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 1;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D34',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 1;
                    })->count()
                );

                // Primaria completa
                $event->sheet->setCellValue(
                    'C35',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 2;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D35',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 2;
                    })->count()
                );

                // Secundaria completa
                $event->sheet->setCellValue(
                    'C37',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 3;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D37',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 3;
                    })->count()
                );

                // Bachillerato completo
                $event->sheet->setCellValue(
                    'C41',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 4;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D41',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 4;
                    })->count()
                );

                // Licenciatura completa
                $event->sheet->setCellValue(
                    'C43',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 5;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D43',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 5;
                    })->count()
                );

                // Posgrado completo
                $event->sheet->setCellValue(
                    'C44',
                    $male_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 6;
                    })->count()
                );
                $event->sheet->setCellValue(
                    'D44',
                    $female_evaluators->filter(function ($instructor, $key) {
                        return $instructor['last_grade'] == 6;
                    })->count()
                );
            }
        ];
    }
}
