<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No personal data here: only which column of which record was anonymized, and a keyed fingerprint of the result.
        Schema::create(config('quebec-retention.table', 'quebec_retention_tombstones'), function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->string('model_id');
            $table->string('column', 100);
            $table->string('fingerprint', 64);
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['model_type', 'model_id', 'column']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-retention.table', 'quebec_retention_tombstones'));
    }
};
