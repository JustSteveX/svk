<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mime_type', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
