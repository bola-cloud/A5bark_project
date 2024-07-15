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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('ar_head');
            $table->string('ar_title');
            $table->text('ar_content');
            $table->string('en_head');
            $table->string('en_title');
            $table->text('en_content');
            $table->string('image')->nullable();

            $table->unsignedBigInteger('news_category_id')->nullable();
            $table->foreign('news_category_id')->references('id')->on('news_categories')
            ->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
