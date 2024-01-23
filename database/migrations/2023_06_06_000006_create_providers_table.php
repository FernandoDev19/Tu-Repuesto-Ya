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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("nit_empresa")->unique();
            $table->string("razon_social")->unique();
            $table->string('pais');
            $table->string("departamento");
            $table->string("municipio");
            $table->string("direccion");
            $table->string("celular")->unique();
            $table->string("telefono")->nullable()->unique();
            $table->string('representante_legal')->nullable();
            $table->string('contacto_principal')->nullable();
            $table->string("email")->unique();
            $table->string('email_secundario')->nullable();
            $table->string("password");
            $table->json('marcas_preferencias')->nullable();
            $table->json('especialidad')->nullable();
            $table->string("rut");
            $table->string("camara_comercio");
            $table->unsignedTinyInteger("estado")->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
