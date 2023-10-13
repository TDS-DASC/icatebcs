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
        Schema::create('training_fields', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->enum('type',['Estatal', 'Federal']);

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
        Schema::dropIfExists('training_fields');
    }
};
