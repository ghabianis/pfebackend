<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
class reclamation extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table ='reclamations';
    protected $fillable = [
        'userId',
        'prenom',
        'nom',
        'email',
        'departement',
        'chef',
        'cause',
        'desc',
        'certife',
        'status',
        'start',
        'end',
        'reject'
    ];

}
