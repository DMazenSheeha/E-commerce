<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
