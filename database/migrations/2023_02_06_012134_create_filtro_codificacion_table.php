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
        Schema::create('filtro_codificacion', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_clase',11)->nullable()->autoIncrement(false);
            $table->foreign('id_clase')
                    ->references('id')
                    ->on('clases')
                    ->onUpdate('set null')
                    ->onDelete('set null');

            $table->string('codigo',16)->unique()->autoIncrement(false);
            $table->string('codigo_buscar',16)->unique()->autoIncrement(false);
            $table->string('descripcion',200);
            $table->decimal('precio', $precision = 10, $scale = 2);
            $table->string('fecha_actualiza',10);
            $table->integer('sincronizado',11)->autoIncrement(false)->default(0);

            $table->unsignedBigInteger('id_tipo',10)->autoIncrement(false)->nullable();
            $table->foreign('id_tipo')
                        ->references('id')
                        ->on('tipos')
                        ->onDelete('set null')
                        ->onUpdate('set null');

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
        Schema::dropIfExists('filtro_codificacion');
    }
};
