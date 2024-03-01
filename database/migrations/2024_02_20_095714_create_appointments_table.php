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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_account_id');
            $table->string('office');
            $table->timestamp('probable_start_time');
            $table->timestamp('actual_end_time');
            $table->string('status');
            $table->date('appointment_taken_date');
            $table->unsignedBigInteger('app_booking_channel_id');
            $table->timestamps();
            $table->foreign('user_account_id')->references('id')->on('client__accounts')->onDelete('cascade');
            $table->foreign('app_booking_channel_id')->references('id')->on('app__booking__channels')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
