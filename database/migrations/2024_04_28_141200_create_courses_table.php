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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();
            
            $table->text('ar_description')->nullable();
            $table->text('en_description')->nullable();

            $table->string('image')->nullable();

            $table->float('price');
            $table->float('trainer_ratio');

            $table->enum('subscription_type', ['limitted', 'unlimitted'])->default('unlimitted');
            $table->integer('subscription_long')->nullable();// number of monthes of subscription in case of limited

            $table->boolean('is_active')->default(0);
            $table->boolean('is_top_course')->default(0);
            
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->foreign('trainer_id')->references('id')->on('users')
            ->onUpdate('CASCADE')->onDelete('SET NULL');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
