<?php

namespace Database\Seeders;

use App\Models\TrainingField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $jsonData = json_decode(file_get_contents("database/jsons/training_fields.json"), true);
        
        foreach($jsonData as $value){
            $trainingField = new TrainingField();
            $trainingField->key = $value['key'];
            $trainingField->name = $value['name'];
            $trainingField->status = $value['status'];
            $trainingField->type = $value['type'];
            $trainingField->save();
        }
    }
}
