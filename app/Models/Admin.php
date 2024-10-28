<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'type',
        'status',
        'email',
        'password',
        'avatar',
    ];
    protected $hidden = [
    'password', 'remember_token',
];

}




