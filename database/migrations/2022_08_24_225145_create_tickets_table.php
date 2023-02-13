<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_ticket', 20);
            $table->string('fecha_registro', 20);
            $table->string('usuario_registro', 20);
            $table->string('ticket_registro');
            $table->string('imagen_ticket_registro');

            $table->unsignedBigInteger('prioridad_id')->nullable();
            $table->foreign('prioridad_id')->references('id')->on('prioridades')->cascadeOnDelete();

            $table->unsignedBigInteger('impacto_id')->nullable();
            $table->foreign('impacto_id')->references('id')->on('impacto')->cascadeOnDelete();

            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->cascadeOnDelete();

            $table->unsignedBigInteger('clasificacion_id')->nullable();
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones')->cascadeOnDelete();

            $table->unsignedBigInteger('tecnico_responsable')->nullable();
            $table->foreign('tecnico_responsable')->references('id')->on('users')->cascadeOnDelete();

            $table->string('fecha_inicio_ticket')->nullable();
            $table->string('diagnostico_ticket')->nullable();

            $table->string('fecha_fin_ticket')->nullable();
            $table->string('respuesta_ticket')->nullable();

            $table->string('fecha_respuesta_cliente')->nullable();
            $table->string('respuesta_cliente')->nullable();

            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->cascadeOnDelete();

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
        Schema::dropIfExists('tickets');
    }
}
