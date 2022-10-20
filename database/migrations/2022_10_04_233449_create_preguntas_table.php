<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->string('examen');
            $table->string('pregunta');
            $table->string('respuesta_correcta');
            $table->string('respuesta_uno');
            $table->string('respuesta_dos');
            $table->string('respuesta_tres');
            $table->timestamps();

           // $table->foreignId('id')->constrained('examens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
