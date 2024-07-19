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
        Schema::create('adverticements', function (Blueprint $table) {
            $table->id();
            $table->string('ar_head');
            $table->string('ar_title');
            $table->text('ar_content');
            $table->string('en_head');
            $table->string('en_title');
            $table->text('en_content');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverticements');
    }
};
