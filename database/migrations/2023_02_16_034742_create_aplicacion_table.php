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
        Schema::create('aplicacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo', 11)->autoIncrement(false)->unsigned();
            $table->foreign('id_tipo')
                ->references('id')
                ->on('aplicacion_tipo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('id_marca', 11)->autoIncrement(false)->unsigned();
            $table->foreign('id_marca')
                ->references('id')
                ->on('aplicacion_marca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('id_vehiculo', 11)->autoIncrement(false)->unsigned();
            $table->foreign('id_vehiculo')
                ->references('id')
                ->on('aplicacion_vehiculo');

            $table->string('aplicacion', 24);

            $table->unsignedBigInteger('id_filtro', 11)->autoIncrement(false)->default(0);
            $table->foreign('id_filtro')
                ->references('id')
                ->on('filtro_codificacion')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->string('codigo',16);

            $table->string('detalle',64);
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
        Schema::dropIfExists('aplicacion');
    }
};
