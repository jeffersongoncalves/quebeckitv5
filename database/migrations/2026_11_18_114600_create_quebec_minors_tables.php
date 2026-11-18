<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-minors.tables.assurances', 'quebec_age_assurances'), function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->unsignedTinyInteger('age');
            $table->string('method', 30);
            $table->string('provider')->nullable();
            $table->timestamp('assured_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create(config('quebec-minors.tables.guardians', 'quebec_guardian_links'), function (Blueprint $table) {
            $table->id();
            $table->morphs('minor');
            $table->morphs('guardian');
            $table->string('relationship')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-minors.tables.guardians', 'quebec_guardian_links'));
        Schema::dropIfExists(config('quebec-minors.tables.assurances', 'quebec_age_assurances'));
    }
};
