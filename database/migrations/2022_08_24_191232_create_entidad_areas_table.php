<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('descripcion', 250)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('entidad_id')->nullable();
            $table->foreign('entidad_id')->references('id')->on('entidad')->cascadeOnDelete();
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
        Schema::dropIfExists('entidad_areas');
    }
}
