<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'role_id',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'role_id' => UserRole::class,
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  public function isAdmin(): Attribute
  {
    return Attribute::make(
      get: fn () => $this->role_id->isSuperAdmin() || $this->role_id->isAdmin(),
    );
  }
}
