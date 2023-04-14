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
            $table->string('codigo_ticket', 20)->nullable();
            $table->string('fecha_registro', 20);

            $table->unsignedBigInteger('usuario_registro')->nullable();
            $table->foreign('usuario_registro')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('cliente_usuario_registro')->nullable();
            $table->foreign('cliente_usuario_registro')->references('id')->on('entidad_colaboradores')->cascadeOnDelete();

            $table->unsignedBigInteger('compania_id')->nullable();
            $table->foreign('compania_id')->references('id')->on('entidad')->cascadeOnDelete();

            $table->string('nombre_usuario_clasificacion')->nullable();
            $table->string('ticket_titulo_registro');
            $table->text('ticket_descripcion_registro');
            $table->string('imagen_ticket_registro')->nullable();

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

            $table->boolean('asignado')->default(false);

            $table->string('fecha_inicio_ticket')->nullable();
            $table->text('diagnostico_ticket')->nullable();

            $table->string('fecha_fin_ticket')->nullable();
            $table->text('respuesta_ticket')->nullable();

            $table->string('fecha_respuesta_cliente')->nullable();
            $table->text('respuesta_cliente')->nullable();

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
