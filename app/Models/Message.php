<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [

            'sender_id',
            'artwork_title',
            'artwork_image',
            'name',
            'email',
            'body',
            'phone',
           'subject',
           'image',
            'read',
           'reply',
           'archived',
        
    ];

//Relation to Artwork
    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
