<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
class bookingss extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table ='bookings';
    protected $fillable = [
        'userId',
        'email',
        'title',
        'departement',
        'chef',
        'start',
        'end',
        'status',
        'reject',
        ];
}
