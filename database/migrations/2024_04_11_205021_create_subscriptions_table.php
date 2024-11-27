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
    Schema::create('subscriptions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignId('course_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->date('date_subscription')->nullable(); //add on payment confirmation
      $table->enum('status', ['pending', 'active', 'completed', 'canceled'])->default('pendig');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('subscriptions');
  }
};
