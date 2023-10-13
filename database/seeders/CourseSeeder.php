<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/courses.json"), true);

        foreach($jsonData as $value){
            $course = new Course();
            $course->key = $value['key'];
            $course->name = $value['name'];
            $course->description = $value['description'];
            $course->type_course = $value['type_course'];
            $course->duration_course = $value['duration_course'];
            $course->modality_course = $value['modality_course'];
            $course->constancy_type = $value['constancy_type'];
            $course->themes = $value['themes'];
            $course->training_field_id = $value['training_field_id'];
            $course->save();

            if(isset($value['themes'])){
                $themes = explode('.', $value['themes']); // agregamos los temas del curso a la tabla themes 
                   foreach($themes as $theme){
                    $theme = trim($theme);
                    if(!empty($theme)){
                        $course->themes()->create([
                            'name' => $theme
                        ]);
                    }/* else{
                        error_log('asdad');
                    } */
                }
            }

        }
    }
}
