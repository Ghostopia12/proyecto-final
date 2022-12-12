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
        Schema::create('puntuaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_equipo');
            $table->integer('partidos_ganados')->unsigned();
            $table->integer("partidos_perdidos")->unsigned();
            $table->integer("partidos_empatados")->unsigned();
            $table->integer("partidos_jugados")->unsigned();
            $table->integer("goles_favor")->unsigned();
            $table->integer("goles_contra")->unsigned();
            $table->integer("puntos")->unsigned();
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
        Schema::dropIfExists('puntuaciones');
    }
};
