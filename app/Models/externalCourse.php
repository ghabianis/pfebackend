<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Models\utilisateur;
class externalCourse extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table ='external_courses';

    protected $fillable = [
        'userId',
        'email',
        'coursePrice',
        'desc',
        'start',
        'end',
        'accepted',
        'rejected'
        ];

}
