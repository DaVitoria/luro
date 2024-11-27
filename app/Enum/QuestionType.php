<?php

namespace App\Enum;

enum QuestionType: string
{
  case MULTIPLE_CHOICE = 'multiple_choice';
  case OPEN = 'open';

  public static function toArray(): array
  {
    return [
      [
        'id' => self::MULTIPLE_CHOICE->value,
        'name' => 'Múltipla Escolha',
      ],
      [
        'id' => self::OPEN->value,
        'name' => 'Aberta',
      ],
    ];
  }

  public function name(): string
  {
    return match ($this) {
      self::MULTIPLE_CHOICE => 'Múltipla Escolha',
      self::OPEN => 'Aberta',
    };
  }

  public function isMultipleChoice()
  {
    return $this === self::MULTIPLE_CHOICE;
  }

  public function isOpen()
  {
    return $this === self::OPEN;
  }
}
