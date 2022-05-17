<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Materil;
class makeReservations extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table ='make_reservations';

    protected $fillable = [
        'userId',
        'email',
        'mouse',
        'desk',
        'screen',
        'start',
        'end',
        'accept',
        'reject'
        ];
        // public function Material()
        // {
        //     return $this->hasOne(Materil::class);
        // }


}

