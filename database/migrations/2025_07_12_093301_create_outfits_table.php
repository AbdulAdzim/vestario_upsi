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
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            // 🧵 Additional fields for filtering and display
            $table->string('type')->nullable();           // e.g. fullset, accessories, top, bottom
            $table->string('gender')->nullable();         // e.g. male, female
            $table->string('status')->default('available'); // available or not available
            $table->json('available_sizes')->required();  // Sizes: S to XXL

            $table->string('image_path')->nullable();     // Outfit preview image
            $table->boolean('is_featured')->default(false); // Highlighted on user page

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfits');
    }
};
