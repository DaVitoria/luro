<?php

namespace App\Models;

use App\Enum\SupportMaterialType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMaterial extends Model
{
  use HasFactory;
  protected $guarded = ['id'];
  protected function casts(): array
  {
    return [
      'material_type' => SupportMaterialType::class,
    ];
  }
}
