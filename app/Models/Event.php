<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'starts_on',
        'ends_on',
        'gmap_link',
        'fb_link',
    ];

    protected $casts = [
        'starts_on' => 'date',
        'ends_on' => 'date',
    ];
}
