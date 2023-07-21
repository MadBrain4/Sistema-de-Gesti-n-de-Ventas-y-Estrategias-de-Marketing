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
        Schema::create('distribuidoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('email',255)->unique();
            $table->string('email2',255)->unique();
            $table->string('direccion',255);
            $table->string('pais',30);
            $table->string('estado',56);
            $table->string('ciudad',255);
            $table->string('telefono',255)->unique();
            $table->string('telefono2',255)->unique();
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
        Schema::dropIfExists('distribuidoras');
    }
};
