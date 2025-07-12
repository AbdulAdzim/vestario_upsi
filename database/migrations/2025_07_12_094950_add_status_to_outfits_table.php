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
    Schema::table('outfits', function (Blueprint $table) {
        $table->string('status')->nullable(); // e.g. "Out of Stock", "Available Soon"
    });
}

public function down(): void
{
    Schema::table('outfits', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
