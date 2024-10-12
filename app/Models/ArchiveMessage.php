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
        'archive_artwork_id'
    ];

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}
