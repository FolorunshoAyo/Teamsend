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
        Schema::create('clicked_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sent_email_id')->constrained('sent_emails');
            $table->string('url_clicked');
            $table->dateTime('click_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicked_links');
    }
};
