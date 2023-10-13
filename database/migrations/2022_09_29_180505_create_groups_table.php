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


     /* 
     
     centro 
     1 instructor (del centro)
     1 curso 
     N estudiantes (del centro)
     fecha inicio
     fecha fin

     hora de inicio y fin 
  
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            // $table->string('name');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places');
            
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('instructors');
            
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers');
            
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->time('time_start');
            $table->time('time_end');
    //        $table->float('price_instructor');
    //        $table->float('price_student')->default(0);
    //        $table->integer('min_students');
    //        $table->integer('max_students');
    //        $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('groups');
    }
};
