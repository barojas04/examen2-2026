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
        Schema::create('material_unidades', function (Blueprint $table) {
            $table->string('idMaterialUnidad')->primary();
            $table->integer('cantidad')->default(0);
            $table->string('codigo');
            $table->string('idUnidad');
            $table->string('codigoPresupuesto')->nullable();
            
            $table->foreign('codigo')->references('codigo')->on('materiales')->onDelete('cascade');
            $table->foreign('idUnidad')->references('idUnidad')->on('unidades')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_unidades');
    }
};
