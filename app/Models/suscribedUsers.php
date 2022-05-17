<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
class suscribedUsers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public $table ='suscribed_users';
    protected $fillable = [
        'userId',
        'username',
        'userEmail',
        'courseId'
    ];
}
