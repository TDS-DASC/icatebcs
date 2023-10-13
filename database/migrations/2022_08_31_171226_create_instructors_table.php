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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();

            $table->string('key')->nullable();
            $table->string('avatar_path')->default('cover.jpg')->nullable();
            $table->tinyInteger('evaluador')->default(0);
            $table->string('evaluator_code', 40)->nullable();
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('curp');
            $table->string('rfc');
            $table->string('birth_place')->nullable();
            $table->date('birthdate');
            $table->enum('marital_status',['Casado','Soltero', 'Viudo', 'Union libre', 'Divorciado']);
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('telephone_number')->nullable();

            $table->tinyInteger('curriculum')->default(0);
            $table->tinyInteger('curriculum_vitae')->default(0);
            $table->tinyInteger('account_status')->default(0); 
            $table->tinyInteger('last_grade')->default(0);
            $table->tinyInteger('alineacion_217')->default(0);
            $table->tinyInteger('alineacion_301')->default(0);

            $table->tinyInteger('standard_ec0038')->default(0);
            $table->tinyInteger('standard_ec0128')->default(0);
            $table->tinyInteger('standard_ec0076')->default(0);
            $table->tinyInteger('standard_ec0249')->default(0);
            $table->tinyInteger('standard_ec0305')->default(0);
            $table->tinyInteger('standard_ec0105')->default(0);
            $table->tinyInteger('standard_ec0127')->default(0);
            $table->tinyInteger('standard_ec0435')->default(0);
            $table->tinyInteger('standard_ec0081')->default(0);
            $table->string('other_standard')->nullable();

            $table->tinyInteger('document_study')->default(0);
            $table->tinyInteger('document_account_status')->default(0);
            $table->string('acquired_grade')->default("");
            $table->tinyInteger('own_certifications')->default(0);

            $table->tinyInteger('document_rfc')->default(0);
            $table->tinyInteger('document_address')->default(0);
            $table->tinyInteger('document_curp')->default(0);
            $table->tinyInteger('document_official_ine')->default(0);
            $table->tinyInteger('document_certificate_medical')->default(0);
            $table->tinyInteger('document_bank_account')->default(0);
            $table->date('admission_date')->nullable();
            $table->date('suspension_date')->nullable();
            $table->longText('observations')->nullable();
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('interbank_key');
            $table->string('bank_account');
            $table->string('card_number')->nullable();
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers');

            // discapacidad y grupos vulnerables
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
        Schema::dropIfExists('instructors');
    }
};
