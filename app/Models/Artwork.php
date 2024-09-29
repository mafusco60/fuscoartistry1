<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

   
}
