<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
class todoModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table ='todo_tasks';
    protected $fillable = [
        'userId',
        'title',
        'content',
        'start',
        'end',
        'active',
        'paused',
        'completed',
    ];
}
