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
        Schema::create('venta', function (Blueprint $table) {
            $table->id();

            $table->integer('id_users',11)->autoIncrement(false)->default(0);
            $table->string('tipo_cliente',50);
            
            $table->string('num_comprobante',100);
            $table->date('fecha');
            $table->string('estado',50);
            $table->decimal('precio_bruto', $precision = 6, $scale = 2)->autoIncrement(false)->default(0.00);
            $table->decimal('precio_total', $precision = 6, $scale = 2)->autoIncrement(false)->default(0.00);
            $table->decimal('descuento', $precision = 6, $scale = 2)->autoIncrement(false)->default(0.00)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
