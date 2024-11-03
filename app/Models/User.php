<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "firstname",
        "lastname",
        'email',
        'password',
        'avatar',
        'phone',
        'subscribe',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship with Artwork
    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class);
    }
    // Relationship with Favorites

    /* public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'favorites', 'user_id', 'artwork_id')
                    ->withTimestamps();
    } */

    //Relationship With Bookmark
  public function favorites() {
    return $this->belongsToMany(Artwork::class, 'favorites', 'user_id', 'artwork_id');
  }

    // Relationship with Messages
    public function message(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id')->with ('artwork');
    }
    
}


