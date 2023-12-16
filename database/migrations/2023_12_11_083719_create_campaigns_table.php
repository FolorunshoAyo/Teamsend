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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_org_id')->constrained('user_organisations');
            $table->string('campaign_name');
            $table->text('campaign_description')->nullable();
            $table->string('subject');
            $table->string('set_from');
            $table->string('reply_to');
            $table->foreignId('html_template')->constrained('templates');
            $table->foreignId('list')->constrained('lists');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
