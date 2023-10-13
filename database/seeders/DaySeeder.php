<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'name' => 'Lunes',
            ],
            [
                'name' => 'Martes',
            ],
            [
                'name' => 'Miercoles',
            ],
            [
                'name' => 'Jueves',
            ],
            [
                'name' => 'Viernes',
            ],
            [
                'name' => 'Sabado',
            ],
            [
                'name' => 'Domingo',
            ],
        ];

        
        foreach($days as $day){
            Day::create([
                'name' => $day['name']
            ]);
        }
    }
}
