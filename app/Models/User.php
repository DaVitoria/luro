<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'role' => Role::class,
      'password' => 'hashed',
    ];
  }

  public function getNameAttribute()
  {
    return  $this->first_name . ' ' . $this->last_name;
  }
  public function getImageUrlAttribute()
  {

    return $this->image ? Storage::url($this->image) : asset('/assets/images/incognito.jpg');
  }

  public function courses(): HasMany
  {
    return $this->hasMany(Course::class);
  }
  public function subscriptions(): HasMany
  {
    return $this->hasMany(Subscription::class);
  }
  public function coursesubs()
  {
    return $this->hasManyThrough(Subscription::class, Course::class);
  }
}
