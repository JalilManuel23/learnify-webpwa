<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_cursos', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->string('estudiante');
            $table->string('calificacion');
            $table->string('comentario');
            $table->string('fecha');
            $table->timestamps();

           // $table->foreignId('id')->constrained('cursos');
            //$table->foreignId('id')->constrained('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_cursos');
    }
}
