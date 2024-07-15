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
        Schema::create('track_grades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('ar_title');
            $table->string('en_title');

            $table->integer('from');
            $table->integer('to');

            $table->string('image');

            $table->boolean('is_active')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_grades');
    }
};
