<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-incidents.table', 'quebec_incidents'), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // The register (Regulation respecting confidentiality incidents, s. 6).
            $table->text('description')->nullable();
            $table->text('circumstances')->nullable();
            $table->timestamp('occurred_at')->nullable();
            $table->timestamp('discovered_at');
            $table->json('data_categories')->nullable();
            $table->unsignedInteger('affected_persons')->nullable();
            // Risk of serious injury (s. 3.7).
            $table->string('risk', 12)->nullable();
            $table->text('sensitivity')->nullable();
            $table->text('consequences')->nullable();
            $table->text('likelihood')->nullable();
            $table->text('measures')->nullable();
            $table->timestamp('notice_due_at')->nullable()->index();
            $table->timestamp('cai_notified_at')->nullable();
            $table->string('cai_reference')->nullable();
            $table->timestamp('persons_notified_at')->nullable();
            $table->text('persons_notice_delay_reason')->nullable();
            $table->timestamp('public_notice_at')->nullable();
            $table->text('public_notice_reason')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('keep_until')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-incidents.table', 'quebec_incidents'));
    }
};
