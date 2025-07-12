<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            if (!Schema::hasColumn('outfits', 'type')) {
                $table->string('type')->nullable();
            }
            if (!Schema::hasColumn('outfits', 'gender')) {
                $table->string('gender')->nullable();
            }
            // Remove status to avoid duplicate (already exists)
        });
    }

    public function down(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            if (Schema::hasColumn('outfits', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('outfits', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
