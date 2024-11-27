<?php

namespace App\Models;

use App\Enum\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use HasFactory;
  protected $guarded = ['id'];
  protected function casts(): array
  {
    return [
      'status' => PaymentStatus::class,
    ];
  }
}
