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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',65);

            $table->unsignedBigInteger('id_producto', 11)->autoIncrement(false);
            $table->foreign('id_producto')
                    ->references('id')
                    ->on('productos')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedBigInteger('id_clase')->autoIncrement(false)->nullable();
            $table->foreign('id_clase')
                    ->references('id')
                    ->on('clases')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->dateTime('created_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
