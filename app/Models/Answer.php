<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'is_correct' => 'boolean',
    ];
  }

  public function question()
  {
    return $this->belongsTo(Question::class);
  }
}
