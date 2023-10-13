<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = json_decode(file_get_contents("database/jsons/instructores2-dic.json"),true);


        foreach($jsonData as $value){

            $address = Address::create([
                'colonia' =>  $value['address']['colonia'],
                'calle' =>  $value['address']['calle'],
                'codigo_postal' => $value['address']['codigo_postal'],
                'numero' => $value['address']['numero'],
                'city_id' => $value['address']['city_id']
            ]);


            $instructor = new Instructor();
            //id
            $instructor->last_name = $value['last_name'];
            $instructor->first_name = $value['first_name'];
            $instructor->name = $value['nombre'];
            $instructor->key = $value['key'];
            $instructor->birthdate = $value['birthdate'];
        //    $instructor->avatar_path = $value['avatar_path'];
            $instructor->email = $value['email'];
            $instructor->phone_number = $value['phone_number'];
            $instructor->telephone_number = $value['telephone_number'];


            //
            $instructor->curriculum = $value['curriculum'];
            $instructor->account_status = $value['document_bank_account'];
            $instructor->last_grade = $value['ultimo_estudios'];
            $instructor->alineacion_217 = $value['alineacion217'];
            $instructor->alineacion_301 = "0";
            $instructor->document_study = $value['docto_estudio'];
            $instructor->document_account_status = $value['document_bank_account'];
            $instructor->acquired_grade = $value['grado_adquirido'];
            $instructor->own_certifications = $value['certificaciones_propias'];
            //

            
            $instructor->evaluador = '0';
            $instructor->curp = $value['curp'];
            $instructor->rfc = $value['rfc'];
            $instructor->birth_place = $value['lugar_nacimiento'];
            $instructor->marital_status = $value['marital_status'];
            $instructor->document_rfc = $value['document_rfc'];
            $instructor->document_address = $value['document_address'];
            $instructor->document_curp = $value['document_curp'];
            $instructor->document_official_ine = $value['document_official_ine'];
            $instructor->document_certificate_medical = $value['document_certificate_medical'];
            $instructor->document_bank_account = $value['document_bank_account'];
            $instructor->admission_date = $value['admission_date'];
            $instructor->observations = $value['observations'];
            $instructor->bank_id = $value['bank_id'];
            $instructor->interbank_key = $value['interbank_key'];
            $instructor->bank_account = $value['bank_account'];
            $instructor->address_id = $address->id;
            $instructor->center_id = '1';


            $instructor->save();
     
            
         }
    }
}
