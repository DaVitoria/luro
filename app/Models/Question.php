<?php

namespace App\Models;

use App\Enum\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected function casts(): array
  {
    return [
      'type' => QuestionType::class,
    ];
  }
  public function answers()
  {
    return $this->hasMany(Answer::class);
  }
}
