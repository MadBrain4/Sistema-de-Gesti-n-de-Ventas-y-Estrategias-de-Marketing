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
        Schema::create('users_webfiltros', function (Blueprint $table) {
            $table->id();
            
            $table->string('name',50);
            $table->string('email',75)->unique();
            $table->string('password',255);
            $table->string('genero',20);
            $table->string('pais',75);
            $table->string('estado',50);
            $table->string('direccion',255);
            $table->string('telefono',20);
            $table->date('fecha_nacimiento');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_webfiltros');
    }
};
