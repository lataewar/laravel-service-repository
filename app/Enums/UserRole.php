<?php

namespace App\Enums;

enum UserRole: int
{
  case SUPER_ADMIN = 1;
  case ADMIN       = 2;
  case PENGGUNA     = 3;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isSuperAdmin(): bool
  {
    return $this === self::SUPER_ADMIN;
  }

  public function isAdmin(): bool
  {
    return $this === self::ADMIN;
  }

  public function isPengguna(): bool
  {
    return $this === self::PENGGUNA;
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "Super Administrator",
      self::ADMIN => "Administrator",
      self::PENGGUNA => "Pengguna",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "danger",
      self::ADMIN => "warning",
      self::PENGGUNA => "success",
    };
  }

  public function getLabelHTML(): string
  {
    return sprintf(
      '<span class="label label-light-%s font-weight-bold label-inline">%s</span>',
      $this->getLabelColor(),
      $this->getLabelText()
    );
  }
}
