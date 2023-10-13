<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('no_control')->nullable();
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers');
            $table->string('avatar_path')->default('cover.jpg')->nullable();
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('curp');
            $table->date('birthdate');
            $table->enum('gender',['Hombre','Mujer','Otro']);
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('birth_place')->nullable();
            
            $table->string('academic_level', 30);
            $table->enum('marital_status',['Casado','Soltero', 'Viudo', 'Union libre', 'Divorciado']);
            
            $table->string('acquired_grade',30)->nullable();
            $table->tinyInteger('disability_visual')->default(0);
            $table->tinyInteger('disability_motor')->default(0);
            $table->tinyInteger('disability_hearing')->default(0);
            $table->tinyInteger('disability_intellectual')->default(0);
            $table->tinyInteger('disability_communication')->default(0);
            
            $table->tinyInteger('group_adolescente')->default(0);
            $table->tinyInteger('group_jefamilia')->default(0);
            $table->tinyInteger('group_indigenas')->default(0);
            $table->tinyInteger('group_cereso')->default(0);
            $table->tinyInteger('group_terceraedad')->default(0);
            $table->tinyInteger('group_migrantes')->default(0);
            
            $table->enum('job_condition', ['Empleado', 'Desempleado','Pensionado', 'Jubilado', 'Iniciativa Privada', 'Estudiante', 'Gobierno', 'Propio Jefe', 'Social']);
            $table->string('job_company')->nullable();
            $table->integer('years_worked')->nullable();
            $table->string('job_position')->nullable();
            $table->string('address_job')->nullable();
            $table->string('job_phone_number')->nullable();
            
       /*   $table->string('document_study')->nullable();
            $table->string('document_birth')->nullable();
            $table->string('document_address')->nullable(); por què son string ? XD
            $table->string('document_curp')->nullable();
            $table->string('document_photos')->nullable();
            $table->string('document_official_ine')->nullable();
            $table->string('document_foreign')->nullable();    */
            
            $table->tinyInteger('document_official_ine')->default(0);
            $table->tinyInteger('document_passport')->default(0);
            $table->tinyInteger('document_curp')->default(0);
            $table->tinyInteger('document_fmm2_fmm3')->default(0);
            $table->tinyInteger('document_responsive_card')->default(0);


            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
