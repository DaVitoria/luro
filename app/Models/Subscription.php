<?php

namespace App\Models;

use App\Enum\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'status' => SubscriptionStatus::class,
    ];
  }

  public function payment(): HasOne
  {
    return $this->hasOne(Payment::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
  public function course(): BelongsTo
  {
    return $this->belongsTo(Course::class);
  }
}
