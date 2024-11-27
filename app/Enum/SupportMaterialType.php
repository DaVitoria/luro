<?php

namespace App\Enum;

enum SupportMaterialType: string
{
  case PDF = 'pdf';
  case ATTACHMENT = 'attachment';

  public static function toArray(): array
  {
    return [
      [
        'id' => self::PDF->value,
        'name' => 'PDF',
      ],
      [
        'id' => self::ATTACHMENT->value,
        'name' => 'Anexo',
      ],
    ];
  }

  public function name(): string
  {
    return match ($this) {
      self::PDF => 'PDF',
      self::ATTACHMENT => 'Anexo',
    };
  }

  public function isPDF()
  {
    return $this === self::PDF;
  }

  public function isAttachment()
  {
    return $this === self::ATTACHMENT;
  }
}
