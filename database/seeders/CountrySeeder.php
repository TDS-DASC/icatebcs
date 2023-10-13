<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/countries.json"), true);

        $data = [];

        foreach ($jsonData as $value) {
            
            $data[] = [
                'name' => $value['name'],
                'code' => $value['code'],
            ];
        }

        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            Country::insert($chunk);
        }
    }
}
