<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogpost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'content', 'media_id', 'album_id'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
