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
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Venta',11)->autoIncrement(false)->default(0);
            $table->foreign('id_Venta')
                ->references('id')
                ->on('venta')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('id_filtro',11)->autoIncrement(false)->default(0);
            $table->foreign('id_filtro')
                ->references('id')
                ->on('filtro_codificacion')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('codigo',50);
            $table->integer('cantidad',100)->autoIncrement(false)->default(0);
            $table->decimal('precio_total', $precision = 6, $scale = 2)->autoIncrement(false)->default(0.00);
            $table->decimal('descuento', $precision = 6, $scale = 2)->autoIncrement(false)->default(0.00)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};
