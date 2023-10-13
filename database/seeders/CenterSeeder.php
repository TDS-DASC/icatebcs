<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\Center;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jsonDataCentros = json_decode(file_get_contents("database/jsons/centers.json"), true);

        foreach ($jsonDataCentros as $value) {
            $address = new Address();
            //$address->id = $value['address']['id'];
            $address->colonia = $value['address']['colonia'];
            $address->calle = $value['address']['calle'];
            $address->codigo_postal = $value['address']['codigo_postal']; 
            $address->numero = $value['address']['numero'];
            $address->city_id = $value['address']['city_id'];
            $address->save();
            $center = new Center();
            //$center->id = $value['id'];
            $center->key = $value['key'];
            $center->name = $value['name'];
            $center->short_name = $value['short_name'];
            $center->center_type = $value['center_type'];
            $center->cover_path = $value['cover_path'];
            $center->address_id= $address->id;
            $center->telephone_number = $value['telephone_number'];
            $center->director_name = $value['director_name'];
            $center->director_position = $value['director_position'];
            $center->save();
        }
    }
}
