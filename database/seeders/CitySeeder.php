<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/cities_mexico.json"), true);

        $data = [];

        foreach ($jsonData as $value) {
            
            $data[] = [
                'id' => $value['id'],
                'state_id' => $value['state_id'],
                'key' => $value['key'],
                'name' => $value['name'],
                'initials' => $value['initials'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            City::insert($chunk);
        }
    }
}
