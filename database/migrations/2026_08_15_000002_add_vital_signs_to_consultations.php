<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->decimal('weight', 5, 2)->nullable()->after('notes');
            $table->decimal('height', 5, 1)->nullable()->after('weight');
            $table->integer('bp_systolic')->nullable()->after('height');
            $table->integer('bp_diastolic')->nullable()->after('bp_systolic');
            $table->decimal('temperature', 4, 1)->nullable()->after('bp_diastolic');
            $table->integer('heart_rate')->nullable()->after('temperature');
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn(['weight', 'height', 'bp_systolic', 'bp_diastolic', 'temperature', 'heart_rate']);
        });
    }
};
