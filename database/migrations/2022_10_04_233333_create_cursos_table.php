<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('instructor');
            $table->string('categoria');
            $table->string('duracion');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('precio');
            $table->timestamps();

            $table->foreignId('id')->constrained('categorias');
            $table->foreignId('id')->constrained('instructores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
