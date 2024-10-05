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
        'name',
        'email',
        'password',
        'avatar',
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

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'favorites', 'user_id', 'artwork_id')
                    ->withTimestamps();
    }

    // Relationship with Messages
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'message', 'artwork_id', 'message_id')
                    ->withTimestamps();
    }
}
