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
    Schema::create('courses', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->text('image');
      $table->string('title');
      $table->string('description');
      $table->decimal('price')->default(0);
      $table->enum('tier', ['free', 'paid']); //role
      $table->enum('validity', ['lifetime', 'one_year']); //validate
      $table->enum('status', ['draft', 'pending', 'rejected', 'approved'])->default('draft');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('courses');
  }
};
