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
        Schema::create('compras', function (Blueprint $table) {
            $table->id(); // id automático
            $table->foreignId('proveedor_id')->constrained('proveedores'); // proveedor_id con relación
            $table->foreignId('usuario_id')->constrained('users'); // usuario_id con relación
            $table->integer('cantidad');
            $table->decimal('precio_total', 10, 2); // precio_total con decimales
            $table->timestamp('fecha_compra')->useCurrent(); // fecha_compra automática
            $table->timestamp('fecha_mod')->nullable()->useCurrentOnUpdate(); // fecha_mod automática
            $table->integer('estado')->default(1); // estado como entero (como querías antes)
            $table->timestamps(); // Crea created_at y updated_at automáticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
