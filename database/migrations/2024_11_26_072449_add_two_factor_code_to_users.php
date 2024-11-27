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
        Schema::table('users', function (Blueprint $table) {
          $table->boolean('two_factor_enabled')->default(true);
          $table->string('two_factor_code')->nullable();
          $table->timestamp('two_factor_expires_at')->nullable();
          $table->string('github_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn(['two_factor_enabled', 'two_factor_code', 'two_factor_expires_at', 'github_token']);
        });
    }
};
