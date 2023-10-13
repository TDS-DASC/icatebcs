<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonDataCentros = json_decode(file_get_contents("database/jsons/places.json"), true);
        foreach ($jsonDataCentros as $value) {
            $address = new Address();
            //$address->id = $value['address']['id'];
            $address->colonia = $value['address']['colonia'];
            $address->calle = $value['address']['calle'];
            $address->codigo_postal = $value['address']['codigo_postal']; 
            $address->numero = $value['address']['numero'];
            $address->city_id = $value['address']['city_id'];
            $address->save();
            $place= new Place();
            //$place->id = $value['id'];
            $place->key = $value['key'];
            $place->name = $value['name'];
            $place->telephone_number = $value['telephone_number'];
            $place->cover_path = $value['cover_path'];
            $place->address_id = $address->id;
            $place->center_id = $value['center'];
            $place->save();
        }
    }
}
