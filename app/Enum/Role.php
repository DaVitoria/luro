<?php

namespace App\Enum;

enum Role: string
{
  case ADMINISTRATOR = 'administrator';
  case INSTRUCTOR = 'instructor';
  case STUDENT = 'student';

  public static function toArray(): array
  {
    return [
      [
        'id' => self::ADMINISTRATOR->value,
        'name' => 'Administrador',
      ],
      [
        'id' => self::INSTRUCTOR->value,
        'name' => 'Instrutor',
      ],
      [
        'id' => self::STUDENT->value,
        'name' => 'Aluno',
      ],
    ];
  }

  public function isAdministrator(): bool
  {
    return $this === self::ADMINISTRATOR;
  }
  public function isInstructor(): bool
  {
    return $this === self::INSTRUCTOR;
  }
  public function isStudent(): bool
  {
    return $this === self::STUDENT;
  }


  public function name(): string
  {
    return match ($this) {
      self::ADMINISTRATOR => 'Administrador',
      self::INSTRUCTOR => 'Instrutor',
      self::STUDENT => 'Aluno',
    };
  }

  public function dashboard(): string
  {
    return match ($this) {
      self::ADMINISTRATOR => 'administrator.dashboard',
      self::INSTRUCTOR => 'instructor.dashboard',
      self::STUDENT => 'student.dashboard',
    };
  }
  public function settings(): string
  {
    return match ($this) {
      self::ADMINISTRATOR => 'administrator.settings',
      self::INSTRUCTOR => 'instructor.settings',
      self::STUDENT => 'student.settings',
    };
  }
}
