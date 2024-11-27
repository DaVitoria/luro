<?php

namespace App\Enum;

enum VideoPlatform: string
{
  case YOUTUBE = 'youtube';
  case VIMEO = 'vimeo';
  case TWITCH = 'twitch';

  public static function toArray(): array
  {
    return [
      [
        'id' => self::YOUTUBE->value,
        'name' => 'YouTube',
      ],
      [
        'id' => self::VIMEO->value,
        'name' => 'Vimeo',
      ],
      [
        'id' => self::TWITCH->value,
        'name' => 'Twitch',
      ],
    ];
  }

  public function name(): string
  {
    return match ($this) {
      self::YOUTUBE => 'YouTube',
      self::VIMEO => 'Vimeo',
      self::TWITCH => 'Twitch',
    };
  }

  public function isYouTube()
  {
    return $this === self::YOUTUBE;
  }

  public function isVimeo()
  {
    return $this === self::VIMEO;
  }

  public function isTwitch()
  {
    return $this === self::TWITCH;
  }
}
