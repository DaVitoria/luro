<?php

namespace App\Enum;

enum SubscriptionStatus: string
{
  case PENDING = 'pending';
  case ACTIVE = 'active';
  case COMPLETED = 'completed';
  case CANCELED = 'canceled';

  public function name(): string
  {
    return match ($this) {
      self::PENDING => 'Pendente',
      self::ACTIVE => 'Ativo',
      self::COMPLETED => 'Completo',
      self::CANCELED => 'Cancelado',
    };
  }

  public function isPending(): bool
  {
    return $this === self::PENDING;
  }
  public function isActive(): bool
  {
    return $this === self::ACTIVE;
  }
  public function isCompleted(): bool
  {
    return $this === self::COMPLETED;
  }
  public function isCanceled(): bool
  {
    return $this === self::CANCELED;
  }

  public function bg(): string
  {
    return match ($this) {
      self::PENDING => 'bg-light',
      self::ACTIVE => 'bg-warning',
      self::COMPLETED => 'bg-success',
      self::CANCELED => 'bg-danger',
    };
  }
}
