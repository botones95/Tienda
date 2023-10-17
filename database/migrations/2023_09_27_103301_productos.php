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
        Schema::create('Productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->string('Codigo')->unique();
            $table->decimal('PVP', 10, 2);
            $table->decimal('Porciento', 10, 2);
            $table->decimal('PT', 10, 2);
            $table->integer('Cantidad');
            $table->string('Proveedor'); 
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
