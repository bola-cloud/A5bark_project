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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('ar_title'); 
            $table->string('en_title'); 
            $table->string('image');
            $table->string('location');
            $table->date('date');
            $table->string('day')->nullable();
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('festival_id')->nullable();
            $table->foreign('festival_id')->references('id')->on('festivals')
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
        Schema::dropIfExists('events');
    }
};
