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
        Schema::create('session_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProveedor');
            $table->foreign('idProveedor')->references('id')->on('providers');
            $table->string('direccion_ip')->nullable();
            $table->string('navegador')->nullable();
            $table->integer('sesiones')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_logs');
    }
};
