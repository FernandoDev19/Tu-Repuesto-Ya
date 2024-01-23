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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSolicitud');
            $table->foreign('idSolicitud')->references('id')->on('solicitudes');
            $table->unsignedBigInteger('idProveedor');
            $table->foreign('idProveedor')->references('id')->on('providers');
            $table->string('repuesto');
            $table->string('tipo_repuesto');
            $table->string('precio');   
            $table->string('garantia');
            $table->string('comentarios')->default('no hay comentarios')->comment('Comentarios opcionales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
