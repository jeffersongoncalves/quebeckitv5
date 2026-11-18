<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-audit-log.table', 'quebec_audit_logs'), function (Blueprint $table) {
            $table->id();
            // String keys: actors and subjects may use int, UUID or ULID primary keys.
            $table->string('actor_type')->nullable();
            $table->string('actor_id')->nullable();
            $table->string('action', 50);
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            // Column names only, never their values.
            $table->json('columns')->nullable();
            $table->string('purpose')->nullable();
            $table->json('metadata')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at');
            $table->string('previous_hash', 64)->nullable();
            $table->string('hash', 64);

            $table->index(['subject_type', 'subject_id']);
            $table->index(['actor_type', 'actor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-audit-log.table', 'quebec_audit_logs'));
    }
};
