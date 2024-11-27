<?php

namespace App\Enum;

enum PaymentStatus: string
{
  case PENDING = 'pending';
  case PAID = 'paid';

  public function name(): string
  {
    return match ($this) {
      self::PENDING => 'Pendente',
      self::PAID => 'Pago',
    };
  }
  public function isPending(): bool
  {
    return $this === self::PENDING;
  }
  public function isPaid(): bool
  {
    return $this === self::PAID;
  }
}
