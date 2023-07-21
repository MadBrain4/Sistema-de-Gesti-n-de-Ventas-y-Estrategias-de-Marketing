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
        Schema::table('tarea_presupuesto', function (Blueprint $table) {
            $table->unsignedBigInteger('id_estrategia')->autoIncrement(false);
            $table->foreign('id_estrategia')
                ->references('id')
                ->on('estrategias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarea_presupuesto', function (Blueprint $table) {
            $table->dropForeign(['id_estrategia']);
            $table->dropColumn('id_estrategia');
        });
    }
};
