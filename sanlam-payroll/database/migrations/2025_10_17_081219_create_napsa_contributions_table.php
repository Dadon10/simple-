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
        Schema::create('napsa_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('month'); // e.g., 2025-10
            $table->decimal('employee_contrib', 12, 2);
            $table->decimal('employer_contrib', 12, 2);
            $table->decimal('total_contrib', 12, 2);
            $table->boolean('reconciled')->default(false);
            $table->timestamps();
            $table->unique(['employee_id', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('napsa_contributions');
    }
};
