<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
class userInfoModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public $table ='user_profile_infos';
    protected $fillable = [
        'userId',
        'nationality',
        'childnb',
        'adress',
        'email',
        'favcol',
        'fcblink',
        'instlink',
        'linkdlink',
        'status'
    ];
}

