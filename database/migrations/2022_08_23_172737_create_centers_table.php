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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->string('name');
            $table->string('short_name');
            $table->enum('center_type', ['Accion movil', 'Unidad de Capacitacion', 'Direccion General']);
            $table->string('cover_path')->default('cover.jpg')->nullable();

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->string('telephone_number');
            $table->string('director_name');
            $table->string('director_position');
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
        Schema::dropIfExists('centers');
    }
};
