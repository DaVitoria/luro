<?php

namespace App\Enum;

enum CourseStatus: string
{
  case DRAFT = 'draft';
  case PENDING = 'pending';
  case REJECTED = 'rejected';
  case APPROVED = 'approved';

  public function name(): string
  {
    return match ($this) {
      self::DRAFT => 'Rascunho',
      self::PENDING => 'Pendente',
      self::REJECTED => 'Rejeitado',
      self::APPROVED => 'Aprovado',
    };
  }

  public function bg(): string
  {
    return match ($this) {
      self::DRAFT => 'bg-light',
      self::PENDING => 'bg-warning',
      self::REJECTED => 'bg-danger',
      self::APPROVED => 'bg-success',
    };
  }

  public function isDraft(): bool
  {
    return $this === self::DRAFT;
  }
  public function isPending(): bool
  {
    return $this === self::PENDING;
  }
  public function isApproved(): bool
  {
    return $this === self::APPROVED;
  }
}
