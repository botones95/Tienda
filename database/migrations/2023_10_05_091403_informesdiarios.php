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
        Schema::create('InformesDiarios', function (Blueprint $table) {
            $table->id();
            $table->Date('Dia');
            $table->decimal('Manana', 10, 2);
            $table->decimal('Tarde', 10, 2);
            $table->decimal('Total', 10, 2);
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
