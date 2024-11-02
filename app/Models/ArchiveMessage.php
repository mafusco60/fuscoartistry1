<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ArchiveMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'archive_name',
        'archive_email',
        'archive_subject',
        'archive_body',
        'archive_reply',
        'archive_upload',
        'original_creation_date',
        'reply_creation_date',
        'archive_sender_id',
        'archive_listing_id',
        'archive_phone',
        'archive_read',
        'archive_artwork_title',
        'archive_artwork_image',
    ];

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class, 'archive_listing_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archive_sender_id');
    }

}
