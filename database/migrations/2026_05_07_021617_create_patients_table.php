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
         Schema::create('patients', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->date('birth_date');
        $table->string('gender');
        $table->string('id_number')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('address')->nullable();
        $table->string('blood_type')->nullable();
        $table->string('insurance')->nullable();
        $table->text('allergies')->nullable();
        $table->text('chronic_conditions')->nullable();
        $table->text('current_medications')->nullable();
        $table->text('notes')->nullable();
        $table->string('status')->default('Activo');
        $table->string('avatar_color')->default('#1a9e8c');
        $table->string('emergency_contact_name')->nullable();
        $table->string('emergency_contact_relation')->nullable();
        $table->string('emergency_contact_phone')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
