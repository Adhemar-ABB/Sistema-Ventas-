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
    Schema::create('productos', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            
            $table->string('nombre');
            $table->string('color')->nullable();
            $table->string('talla')->nullable();
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('precio_compra', 10, 2);
            $table->integer('stock_minimo')->default(0);
            $table->integer('estado')->default(1); 

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
