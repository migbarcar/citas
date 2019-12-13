<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescripcions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dosis');
            $table->string('frecuencia');
            $table->string('instrucciones');
            $table->unsignedInteger('tratamiento_id');
            $table->unsignedInteger('medicina_id');
            $table->timestamps();

            $table->foreign('tratamiento_id')->references('id')->on('tratamientos')->onDelete('restrict');
            $table->foreign('medicina_id')->references('id')->on('medicinas')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescripcions');
    }
}
