<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Models\utilisateur;
class drepartement extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table ='drepartements';
    protected $fillable = [
        'depart_name',
        'chef',
        ];

}