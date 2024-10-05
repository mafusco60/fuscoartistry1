<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [

            'sender_id',
            'artwork_id',
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
//Relation to User
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
//Relation to Artwork
    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'artwork_id');
    }
}
