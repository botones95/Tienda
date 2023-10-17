<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('HistorialVentaProductos', function (Blueprint $table) {
            $table->id();
            $table->String('Fecha');
            $table->string('Nombre');
            $table->string('Codigo');
            $table->integer('Cantidad');
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
