<?php

namespace App\Enum;

enum Validity: string
{
  case LIFETIME = 'lifetime';
  case ONE_YEAR = 'one_year';

  public function isLifetime(): bool
  {
    return $this === self::LIFETIME;
  }
  public function isOneYear(): bool
  {
    return $this === self::ONE_YEAR;
  }

  public function name(): string
  {
    return match ($this) {
      self::LIFETIME => 'Para toda a vida',
      self::ONE_YEAR => 'Um ano',
    };
  }
}
