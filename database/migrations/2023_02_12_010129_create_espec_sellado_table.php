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
        Schema::create('espec_sellado', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_filtro',9)->autoIncrement(false)->unsigned()->default(0);
            $table->foreign('id_filtro')
                ->references('id')
                ->on('filtro_codificacion')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->string('codigo',16)->unique()->autoIncrement(false);
            $table->string('codigo_buscar',16)->unique()->autoIncrement(false);
            $table->decimal('diametroext', $precision = 6, $scale = 2)->default(0.00);
            $table->string('diametroint',24);
            $table->decimal('altura', $precision = 6, $scale = 2)->default(0.00);
            $table->decimal('diametroempext', $precision = 6, $scale = 2)->default(0.00);
            $table->decimal('diametroempint', $precision = 6, $scale = 2)->default(0.00);
            $table->decimal('espesoremp', $precision = 6, $scale = 2)->default(0.00);
            $table->char('valvulaal',1)->default(0);
            $table->char('valvulaad',1)->default(0);
            $table->string('detalle1',64)->default('N/D');
            $table->string('detalle2',64)->default('N/D');
            $table->integer('sincronizado',11)->autoIncrement(false)->default(0);
            $table->string('imagen',25)->nullable();
            $table->string('imagen1',25)->nullable();
            $table->string('imagen2',25)->nullable();
            $table->string('imagen3',25)->nullable();

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
        Schema::dropIfExists('espec_sellado');
    }
};
