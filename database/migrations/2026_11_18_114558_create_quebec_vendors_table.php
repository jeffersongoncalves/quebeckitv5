<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-vendors.table', 'quebec_vendors'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document')->nullable();
            $table->string('role', 20);
            $table->text('services')->nullable();
            $table->json('data_categories')->nullable();
            // Province (QC, ON...) or ISO 3166-1 alpha-2 country where the information is held.
            $table->string('location', 10)->default('QC');
            $table->date('pia_completed_at')->nullable();
            $table->string('pia_reference')->nullable();
            $table->string('risk', 10)->default('medium');
            $table->date('dpa_signed_at')->nullable();
            $table->date('dpa_expires_at')->nullable();
            $table->json('dpa_checklist')->nullable();
            $table->string('contact')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('terminated_at')->nullable();
            $table->timestamp('data_returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-vendors.table', 'quebec_vendors'));
    }
};
