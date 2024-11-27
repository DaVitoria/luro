<?php

namespace App\Enum;



enum Tier: string
{
  case FREE = 'free';
  case PAID = 'paid';

  public function isFree(): bool
  {
    return $this === self::FREE;
  }
  public function isPaid(): bool
  {
    return $this === self::PAID;
  }

  public function name(): string
  {
    return match ($this) {
      self::FREE => 'Grátis',
      self::PAID => 'Pago',
    };
  }
}
