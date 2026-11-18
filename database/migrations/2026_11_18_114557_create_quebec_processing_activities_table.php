<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('quebec-governance.table', 'quebec_processing_activities'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('purpose');
            $table->json('persons')->nullable();
            $table->json('data_categories')->nullable();
            // Models of quebec.models processed by this activity: their #[PersonalData] columns join the inventory.
            $table->json('models')->nullable();
            $table->json('recipients')->nullable();
            $table->json('outside_quebec')->nullable();
            $table->string('retention')->nullable();
            $table->text('security_measures')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('quebec-governance.table', 'quebec_processing_activities'));
    }
};
