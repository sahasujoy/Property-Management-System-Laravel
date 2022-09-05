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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_id');
            $table->integer('land_reg_cost');
            $table->integer('mutation_cost');
            $table->integer('flat_reg_cost');
            $table->integer('poa_cost');
            $table->integer('flat_price');
            $table->integer('utility_charge');
            $table->integer('car_parking');
            $table->integer('additional_cost');
            $table->integer('installments');
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
        Schema::dropIfExists('prices');
    }
};
