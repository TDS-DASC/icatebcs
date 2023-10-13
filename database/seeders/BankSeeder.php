<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/banks.json"), true);

        $data = [];

        foreach ($jsonData as $value) {
            
            $data[] = [
                'clabe' => $value['clabe'],
                'marca' => $value['marca'],
                'nombre' => $value['nombre'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            Bank::insert($chunk);
        }
    }
}
