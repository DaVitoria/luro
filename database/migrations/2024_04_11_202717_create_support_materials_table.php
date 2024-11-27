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
    Schema::create('support_materials', function (Blueprint $table) {
      $table->id();
      $table->foreignId('lesson_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->string('name');
      $table->enum('material_type', ['pdf', 'attachment']); // por se analisar
      $table->text('link_material');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('support_materials');
  }
};
