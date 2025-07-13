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
        Schema::create('outfit_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outfit_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('matric_no');
            $table->string('club');
            $table->text('purpose');
            $table->string('phone');
            $table->string('size');
            $table->date('booking_date');
            $table->date('return_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('outfit_id')->references('id')->on('outfits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfit_bookings');
    }
};
