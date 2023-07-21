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
        Schema::create('tarea_presupuesto', function (Blueprint $table) {
            $table->id();
            $table->string('tarea', 200);
            $table->integer('valor', 30)->autoIncrement(false);
            $table->integer('id_padre', 11)->autoIncrement(false);

            $table->unsignedBigInteger('id_presupuesto')->autoIncrement(false);
            $table->foreign('id_presupuesto')
                ->references('id')
                ->on('presupuesto')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_presupuesto');
    }
};
