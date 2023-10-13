<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use File;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jsonDataCapacitandos = json_decode(file_get_contents("database/jsons/estudiantes.json"), true);
        $jsonDataCapacitandos = array_merge($jsonDataCapacitandos, json_decode(file_get_contents("database/jsons/capacitandos_final.json"), true));
        foreach ($jsonDataCapacitandos as $value) {
            $address = new Address();
            $address->id = $value['address']['id'];
            $address->colonia = $value['address']['colonia'];
            $address->calle = $value['address']['calle'];
            $address->codigo_postal =$value['address']['codigo_postal'];
            $address->numero = $value['address']['numero'];
            $address->city_id = $value['address']['city_id'];
            $address->save();

            $capacitando = new Student();
            $capacitando->id = $value['id'];
            $capacitando->no_control = $value['no_control'];
            $capacitando->center_id = $value['center_id'];
            $capacitando->name = $value['name'];
            $capacitando->first_name = $value['first_name'];
            $capacitando->last_name = $value['last_name'];
            $capacitando->curp = $value['curp'];
            $capacitando->birthdate = $value['birthdate'];
            $capacitando->gender = $value['gender'];
            $capacitando->email = $value['email'];
            $capacitando->phone_number = $value['phone_number'];
            $capacitando->telephone_number = $value['telephone_number'];
            $capacitando->birth_place = $value['birth_place'];
            $capacitando->academic_level = $value['academic_level'];
            $capacitando->disability_visual = $value['disability_visual'];
            $capacitando->disability_motor = $value['disability_motor'];
            $capacitando->disability_hearing = $value['disability_hearing'];
            $capacitando->disability_intellectual = $value['disability_intellectual'];
            $capacitando->disability_communication = $value['disability_communication'];
            $capacitando->group_adolescente = $value['group_adolescente'];
            $capacitando->group_jefamilia = $value['group_jefamilia'];
            $capacitando->group_indigenas = $value['group_indigenas'];
            $capacitando->group_cereso = $value['group_cereso'];
            $capacitando->group_terceraedad = $value['group_terceraedad'];
            $capacitando->group_migrantes = $value['group_migrantes'];
            $capacitando->job_condition = $value['job_condition'];
            $capacitando->job_company = $value['job_company'];
            $capacitando->years_worked = $value['years_worked'];
            $capacitando->job_position = $value['job_position'];
            $capacitando->address_job = $value['address_job'];
            $capacitando->job_phone_number = $value['job_phone_number'];
         /*   $capacitando->document_study = $value['document_study'];
            $capacitando->document_birth = $value['document_birth'];
            $capacitando->document_address = $value['document_address'];
            $capacitando->document_curp = $value['document_curp'];
            $capacitando->document_photos = $value['document_photos'];
            $capacitando->document_official_ine = $value['document_official_ine'];
            $capacitando->document_foreign = $value['document_foreign'];*/
            $capacitando->address_id = $address->id;
            $capacitando->avatar_path = 'cover.jpg';
            $capacitando->save();
        }

       
    }
}
