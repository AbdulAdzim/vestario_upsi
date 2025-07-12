<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->string('status')->nullable()->after('gender');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('outfits', 'status') && DB::getDriverName() !== 'sqlite') {
            Schema::table('outfits', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
