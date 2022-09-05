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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_id');
            $table->integer('land_reg_cost');
            $table->integer('mutation_cost');
            $table->integer('flat_reg_cost');
            $table->integer('poa_cost');
            $table->integer('booking_money');
            $table->integer('downpayment');
            $table->integer('land_piling_money1');
            $table->integer('land_piling_money2');
            $table->integer('building_piling');
            $table->integer('first_roof_cast');
            $table->integer('top_roof_cast');
            $table->integer('final_work_cost');
            $table->integer('car_parking');
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
        Schema::dropIfExists('payments');
    }
};
