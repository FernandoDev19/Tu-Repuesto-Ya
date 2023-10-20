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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->nullable();
            $table->integer('respuestas')->default(0);
            $table->string('marca');
            $table->string('referencia');
            $table->string('modelo');
            $table->string('tipo_de_transmision');
            $table->string('repuesto');
            $table->string('img_repuesto')->nullable();
            $table->text('comentario')->nullable();
            $table->string('nombre');
            $table->string('correo');
            $table->string('numero');
            $table->string('departamento');
            $table->string('municipio');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
