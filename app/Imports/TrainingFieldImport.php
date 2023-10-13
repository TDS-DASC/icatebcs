<?php

namespace App\Imports;

use App\Models\TrainingField;
 
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class TrainingFieldImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure 
{
    use Importable, SkipsFailures, SkipsErrors; 
    /**
    * @param Collection $collection
    */
    public $new_records = 0;
    
    public function model($row)
    // $trainingField->key 
    {
        $tf = new TrainingField([
            'key' =>  $row['codigo'],
            'name' => $row['nombre'],
            'type' => $row['tipo'],
        ]);
        $tf->save();
        // $tf->key =  date("y") . str_pad($tf->id, 3, '0', STR_PAD_LEFT);
        if($tf){
            $this->new_records++;
            return $tf;
        }
        
    }
       
    public function headingRow() : int{ // fila donde que contiene los encabezados
        return 8;
    }

    public function rules():array{
        return [
            'nombre' => 'required',
            'tipo' => ['required', Rule::in(['Estatal', 'Federal'])],
        ];
    }

    public function customValidationMessages(): array{
        return [
            'nombre.required' => 'El nombre es un atributo requerido',
            'tipo.required' => 'El tipo de curso es un atributo requerido (Estatal o Federal)',
            'tipo.in' => 'El tipo de curso no coincide con los tipos permitidos (Estatal o Federa)l' 
        ];
    }
}