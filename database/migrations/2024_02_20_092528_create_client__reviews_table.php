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
        Schema::create('client__reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_account_id');
            $table->unsignedBigInteger('doctor_id');
            $table->char('is_review_anonymous');
            $table->integer('wait_time_rating');
            $table->integer('bedside_manner_rating');
            $table->integer('overall_rating');
            $table->string('review');
            $table->char('is_doctor_recommended');
            $table->date('review_date'); 
            $table->timestamps();

            $table->foreign('user_account_id')->references('id')->on('client__accounts')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client__reviews');
    }
};
