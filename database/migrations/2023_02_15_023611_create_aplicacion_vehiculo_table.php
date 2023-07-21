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
        Schema::create('aplicacion_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marca')->autoIncrement(false);
            $table->foreign('id_marca')
                ->references('id')
                ->on('aplicacion_marca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('modelo',64);
            $table->string('motor',64)->default('N/D');
            $table->string('cilindrada',4)->default('N/D');
            $table->string('ano',8)->default('N/D');
            $table->integer('sincronizado',11)->autoIncrement(false)->default(0);

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
        Schema::dropIfExists('aplicacion_vehiculo');
    }
};
