<?php

namespace App\Models;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'firstname',
        'lastname',
        'type',
        'status',
        'email',
        'password',
        'avatar',
        'phone',
    ];
    protected $hidden = [
    'password', 'remember_token',
];
public function handle(Request $request, Closure $next): Response
{
   if (!Auth::guard('admin')->check()) {
       return redirect()->route('login');
   }
return $next($request);
}
}



