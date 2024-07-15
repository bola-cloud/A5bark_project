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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('ar_title');
            $table->string('en_title');
            $table->string('ar_description');
            $table->string('en_description');
            $table->string('number')->nullable(); 
            $table->string('time')->nullable(); 
            $table->string('video'); 
            $table->string('sound_link')->nullable();
            $table->string('spotify_link')->nullable();
            $table->string('titok_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('playlist_id')->nullable();
            $table->foreign('playlist_id')->references('id')->on('play_lists')
            ->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
