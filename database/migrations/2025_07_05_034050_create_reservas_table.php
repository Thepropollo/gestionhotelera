<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('tipo_reserva');
            $table->unsignedBigInteger('id_objeto');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->string('estado');
            $table->timestamps();

            // Nota: No agregamos clave foránea para id_objeto porque puede apuntar a varias tablas
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
