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
        Schema::create('courses_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('course_category_id');
            $table->foreign('course_category_id')->on('course_categories')->references('id')
            ->onUpdate('CASCADE')->onDelete('CASCADE');
            
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->on('courses')->references('id')
            ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_categories');
    }
};
