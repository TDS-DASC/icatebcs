<?php

namespace App\Imports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use App\Models\City;
use App\Models\Address;
use App\Models\Center;
use App\Models\Place;
class PlaceImport implements ToModel, WithStartRow, WithValidation, SkipsOnError, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param Collection $collection
    */
    public $new_records = 0;
    public function model($row)
    {

        // dd($row);
        $address =  Address::create([
            'colonia' => $row['colonia'],
            'codigo_postal' => $row['codigo_postal'],
            'calle' => $row['calle'],
            'numero' => $row['numero'],
            'city_id' =>  (integer) City::where('name', $row['ciudad'])->pluck('id')[0], 
        ]);
        $address->save();

     
        $center_id = (integer)Center::where('name', $row['centro'])->pluck('id')[0];
        $place = Place::create([
            // 'key' => $row['clave'],
            'name' => $row['nombre'],
            'telephone_number' => $row['telefono'],
            'key' => $row['clave'],
            'center_id' => $center_id,
            'address_id' => $address->id,
            'locality' => $row['localidad']
        ]);
        $place->key =  date("y") . $center_id . str_pad($place->id, 4, '0', STR_PAD_LEFT);

        // $place->save();
     
        // error_log(json_encode($place));
        $this->new_records++;
        return $place;
    }

    public function headingRow(): int
    {
        return 8;
    }

    public function startRow(): int
    {
        return 9;
    }

    public function prepareForValidation($data, $index){
        foreach($data as $key => $value){
            if($value == 'No disponible'){
                // error_log('NO VALIDO'. $value);
                $data[$key] = '';   
            }
        }
        // error_log(json_encode($data));
        return $data;
    }
    public function rules(): array
    {
        return [
            'centro' => 'required|exists:centers,name',
            'ciudad' => 'required|exists:cities,name',
        ];
    }
}
