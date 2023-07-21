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
        Schema::create('responsable_estrategia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_responsable')->autoIncrement(false);
            $table->foreign('id_responsable')
                ->references('id')
                ->on('responsables')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('id_estrategia')->autoIncrement(false);
            $table->foreign('id_estrategia')
                ->references('id')
                ->on('estrategias')
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
        Schema::dropIfExists('responsable_estrategia');
    }
};
