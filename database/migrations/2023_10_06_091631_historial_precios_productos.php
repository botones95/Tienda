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
        Schema::create('HistorialPreciosProductos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Codigo');
            $table->Date('Fecha');
            $table->decimal('PVP', 10, 2);
            $table->decimal('Porciento', 10, 2);
            $table->decimal('PT', 10, 2);
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
