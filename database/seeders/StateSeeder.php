<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/states_mexico.json"), true);

        foreach ($jsonData as $value) {
            
            $state = new State();
            $state->id = $value['id'];
            $state->key = $value['key'];
            $state->name = $value['name'];
            $state->clave = $value['shortname'];
            $state->save();
        }
    }
}
