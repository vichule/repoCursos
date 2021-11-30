<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            $table->unsignedBigInteger('cursos_id');
            $table->foreign('cursos_id')->references('id')->on('cursos');
            
            
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
        Schema::dropIfExists('cursos_usuarios');
    }
}
