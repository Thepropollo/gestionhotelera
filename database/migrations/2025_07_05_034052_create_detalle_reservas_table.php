<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleReservasTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');
            $table->foreignId('servicio_extra_id')->constrained('servicio_extras')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_reserva');
    }
}

