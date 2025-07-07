<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('facturas', function (Blueprint $table) {
        $table->dropForeign(['reserva_id']);  // Si existe FK
        $table->dropColumn('reserva_id');
    });
}

public function down()
{
    Schema::table('facturas', function (Blueprint $table) {
        $table->unsignedBigInteger('reserva_id');
        $table->foreign('reserva_id')->references('id')->on('reservas');
    });
}

};
