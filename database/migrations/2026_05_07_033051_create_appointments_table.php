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
        Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('email');
        $table->string('telefono')->nullable();
        $table->string('tipo')->nullable();
        $table->text('mensaje')->nullable();
        $table->enum('status', ['pendiente','confirmada','cancelada'])->default('pendiente');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
