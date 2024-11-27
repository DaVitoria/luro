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
    Schema::create('lessons', function (Blueprint $table) {
      $table->id();
      $table->foreignId('module_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->string('title');
      $table->string('description');
      $table->integer('lesson_number');
      $table->enum('video_platform', ['youtube', 'vimeo', 'twitch']);
      $table->text('video_url');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lessons');
  }
};
