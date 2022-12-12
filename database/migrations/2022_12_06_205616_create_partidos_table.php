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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("equipo1_id")->unsigned();
            $table->bigInteger("equipo2_id")->unsigned();
            $table->foreign("equipo1_id")->references('id')->on('equipos');
            $table->foreign("equipo2_id")->references('id')->on('equipos');
            $table->String('inicio');
            $table->String('final');
            $table->integer("marcador_equipo1")->unsigned();
            $table->integer("marcador_equipo2")->unsigned();
            $table->boolean('estado');
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
        Schema::dropIfExists('partidos');
    }
};
