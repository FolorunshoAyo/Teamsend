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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_org_id')->constrained('user_organisations');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->boolean('is_subscribed')->default(true);
            $table->boolean('is_blacklisted')->default(false);
            $table->boolean('is_favorite')->default(false);
            $table->boolean('is_trashed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
