<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete()->after('patient_id');
            $table->index('visit_date');
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('doctor_id');
            $table->dropIndex(['visit_date']);
        });
    }
};
