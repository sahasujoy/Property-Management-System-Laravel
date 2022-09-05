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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->integer('land_id');
            $table->string('name');
            $table->string('road_no');
            $table->string('no');
            $table->string('face_direction');
            $table->string('location');
            $table->string('floors');
            $table->string('flats');
            $table->date('start_date');
            $table->date('complete_date');
            $table->date('complete_extended_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
};
