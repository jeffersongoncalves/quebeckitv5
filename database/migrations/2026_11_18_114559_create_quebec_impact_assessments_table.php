<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-pia.table', 'quebec_impact_assessments'), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type', 20)->default('project');
            // laravel-quebec-governance ProcessingActivity, without a foreign key so the table order doesn't matter.
            $table->unsignedBigInteger('processing_activity_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->text('necessity')->nullable();
            $table->json('risks')->nullable();
            $table->text('person_in_charge_opinion')->nullable();
            // Outside Quebec (s. 17).
            $table->string('destination')->nullable();
            $table->text('legal_framework')->nullable();
            $table->boolean('adequate_protection')->nullable();
            // Project (s. 3.3): the system can communicate computerized information in a structured, commonly used format.
            $table->boolean('portability')->nullable();
            $table->string('status', 10)->default('draft');
            $table->timestamp('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamp('next_review_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-pia.table', 'quebec_impact_assessments'));
    }
};
