<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class People extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'people';
    protected $fillable = ["name", "surname", "nickname", "password", "passwordagain", "created_at", "updated_at"];
}
