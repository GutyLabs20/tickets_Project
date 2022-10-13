<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 250);
            $table->string('apellidos', 250);
            $table->string('email', 250);
            $table->string('telefono', 10);
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->foreign('cargo_id')->references('id')->on('entidad_cargos')->cascadeOnDelete();
            $table->string('activo', 1)->default(1);
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
        Schema::dropIfExists('entidad_colaboradores');
    }
}
