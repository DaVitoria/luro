<?php

namespace App\Models;

use App\Enum\CourseStatus;
use App\Enum\Tier;
use App\Enum\Validity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'tier' => Tier::class,
      'validity' => Validity::class,
      'status' => CourseStatus::class,
    ];
  }


  public function getImageUrlAttribute(): string
  {
    return Storage::url($this->image);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }
  public function subscriptions(): HasMany
  {
    return $this->hasMany(Subscription::class);
  }
  public function modules(): HasMany
  {
    return $this->hasMany(Module::class);
  }
  public function lessons(): HasManyThrough
  {
    return $this->hasManyThrough(Lesson::class, Module::class);
  }
}
