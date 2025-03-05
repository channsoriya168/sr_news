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
        Schema::table('articles', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('img_url');

            // Add the new column
            $table->string('img_upload')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('img_upload');

            // Add the old column back
            $table->string('img_url')->nullable();
        });
    }
};
