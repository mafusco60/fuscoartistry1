<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveListing extends Model
{
    use HasFactory;
    protected $fillable = [
        'archive_title',
        'archive_description',
        'archive_medium',
        'archive_search_tags',
        'archive_image',
        'archive_original',
        'archive_featured',
        'archive_original_substrate',
        'archive_original_dimensions',
        'archive_original_price',
        'original_artwork_id',
    ];
}
