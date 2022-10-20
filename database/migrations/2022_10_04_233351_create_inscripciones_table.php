<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->string('estudiante');
            $table->string('curso');
            $table->string('avance');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('estatus');
            $table->timestamps();
            
            //$table->foreignId('id')->constrained('estudiantes');
            //$table->foreignId('id')->constrained('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
