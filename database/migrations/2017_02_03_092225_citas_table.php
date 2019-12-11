<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha_hora');
            $table->unsignedInteger('medico_id');
            $table->unsignedInteger('paciente_id');
            $table->timestamps();

            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('restrict');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');

    }
}
