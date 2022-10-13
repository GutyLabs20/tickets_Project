<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_doc', 20);
            $table->string('nro_doc', 15);
            $table->string('nombre', 250);
            $table->string('slug')->unique()->nullable();
            $table->string('descripcion', 250)->nullable();
            $table->string('logotipo', 250)->nullable();
            $table->string('telefono', 250)->nullable();
            $table->string('email', 250)->nullable();
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
        Schema::dropIfExists('entidad');
    }
}
