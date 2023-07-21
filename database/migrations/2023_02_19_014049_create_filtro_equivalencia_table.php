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
        Schema::create('filtro_equivalencia', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('id_filtro',9)->autoIncrement(false)->unsigned();
            $table->foreign('id_filtro')
                ->references('id')
                ->on('filtro_codificacion')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->string('codigo',16);
            $table->string('codigo_buscar',16);
            $table->string('marca',40)->default('N/D');
            $table->string('codigo_marca',40)->default('N/D');
            $table->string('codigo_marca_buscar',40);

            $table->unsignedBigInteger('id_marca',11)->autoIncrement(false);
            $table->foreign('id_marca')
                ->references('id')
                ->on('equivalencia_marca')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('filtro_equivalencia');
    }
};
