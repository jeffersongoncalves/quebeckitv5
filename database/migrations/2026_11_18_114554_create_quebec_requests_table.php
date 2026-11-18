<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-requests.table', 'quebec_requests'), function (Blueprint $table) {
            $table->id();
            // String keys: subjects may use int, UUID or ULID primary keys. Null until the requester is identified.
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('requester_name')->nullable();
            $table->string('requester_email')->nullable();
            $table->string('type', 30);
            $table->string('status', 20)->index();
            $table->text('details')->nullable();
            $table->text('response')->nullable();
            $table->string('export_path')->nullable();
            $table->timestamp('due_at')->index();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('extended_at')->nullable();
            $table->text('extension_reason')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-requests.table', 'quebec_requests'));
    }
};
