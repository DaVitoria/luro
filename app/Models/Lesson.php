<?php

namespace App\Models;

use App\Enum\VideoPlatform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'video_platform' => VideoPlatform::class,
    ];
  }

  public function supportMaterials()
  {
    return $this->hasMany(SupportMaterial::class);
  }

  public function quizzes()
  {
    return $this->hasMany(Quiz::class);
  }
}
