<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'zip', 'country', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders() {
      return $this->hasMany(Order::class);
    }

    public function cart() {
      return $this->hasOne(Cart::class)
                  ->where('status', 'active');
    }

    public function isAdmin() {
      if($this->role === 'admin')
      {
        return true;
      }
        return false;
    }

    public function role() {
      $role = $this->role;
      return $role;
    }

    public function attachRole($role) {
      $this->role = $role;
      $this->update();
      return true;
    }
}
