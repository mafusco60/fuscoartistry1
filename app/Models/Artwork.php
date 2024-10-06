<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'featured',
        'original',
        'original_price',
        'original_dimensions',
        'original_substrate',
        'search_tags',
        'medium',
  
    ];
// Relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
// Relationship with Favorites
    
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'artwork_id', 'user_id');
    }
    
// Relationship with Messages
    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }

   

   
}
