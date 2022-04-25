<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccination_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->integer('vaccine_id')->unsigned();
            $table->string('lot_number');
            $table->string('number_injections');
            $table->timestamps();
            $table->foreign('child_id')
            ->references('id')->on('children')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('staff_id')
            ->references('id')->on('medical_staff')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('vaccine_id')
            ->references('id')->on('vaccines')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination_details');
    }
}
