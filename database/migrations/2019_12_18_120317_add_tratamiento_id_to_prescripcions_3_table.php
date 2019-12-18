<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTratamientoIdToPrescripcions3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescripcions', function (Blueprint $table) {
            //

            $table->unsignedInteger('tratamiento_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescripcions', function (Blueprint $table) {
            //
            $table->dropColumn('tratamiento_id');

        });
    }
}
