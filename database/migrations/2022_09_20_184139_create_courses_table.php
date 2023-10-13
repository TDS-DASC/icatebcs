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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->string('name');
            $table->longText('description');
            $table->enum('type_course', ['Regular', 'Extensión', 'CAE', 'EBC', 'Integral', 'CAD']);
            $table->integer('duration_course');
            $table->enum('modality_course', ['Presencial', 'Distancia', 'Mixta']);
            $table->enum('constancy_type', ['Regular', 'Extensión', 'Curso Aceleración Específica', 'Capacitación a Distancia'])->nullable();
            $table->longText('themes')->nullable();
            $table->unsignedBigInteger('training_field_id')->nullable();
            $table->foreign('training_field_id')->references('id')->on('training_fields');
            $table->string('status',20)->default('ACTIVO');
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
        Schema::dropIfExists('courses');
    }
};
