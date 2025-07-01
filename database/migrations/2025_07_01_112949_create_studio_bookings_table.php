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
    Schema::create('studio_bookings', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('matrics');
        $table->string('club');
        $table->string('reason');
        $table->string('phone');
        $table->date('start_date');
        $table->date('end_date');
        $table->string('time_slot');
        $table->json('studios'); // This should match your form's array submission
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studio_bookings');
    }
};
