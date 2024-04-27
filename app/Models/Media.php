<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mime_type', 'album_id', 'caption'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function url()
    {
        return 'storage/media/'.$this->name;
    }
}
