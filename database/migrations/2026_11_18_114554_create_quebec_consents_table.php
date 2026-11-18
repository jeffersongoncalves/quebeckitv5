<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-consent.table', 'quebec_consents'), function (Blueprint $table) {
            $table->id();
            // String keys: subjects may use int, UUID or ULID primary keys.
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            // Visitors without an account (cookie banner).
            $table->string('anonymous_id', 64)->nullable();
            $table->string('purpose', 100);
            $table->string('version', 50)->nullable();
            $table->string('action', 10);
            $table->timestamp('expires_at')->nullable();
            $table->string('source', 100)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['subject_type', 'subject_id', 'purpose']);
            $table->index(['anonymous_id', 'purpose']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-consent.table', 'quebec_consents'));
    }
};
