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
     Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_completo', 100);
        $table->string('telefono', 20)->nullable();
        $table->string('correo', 100)->nullable()->unique();
        $table->string('carnet', 20)->unique();
        $table->boolean('estado')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
