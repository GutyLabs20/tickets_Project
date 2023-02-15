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
            $table->string('telefono', 15);
            $table->string('rol', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->unsignedBigInteger('entidad_id')->nullable();
            $table->foreign('entidad_id')->references('id')->on('entidad')->cascadeOnDelete();
            $table->string('created_by', 1)->nullable();
            $table->boolean('activo', true)->default(true);
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
