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
        Schema::create('geolocations', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_departamento');
            $table->string('departamento');
            $table->string('codigo_municipio');
            $table->string('municipio');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geolocations');
    }
};
