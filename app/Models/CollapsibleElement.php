<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollapsibleElement extends Model
{

  use HasFactory;
  public function parent()
  {
    return $this->morphTo();
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }

  public function albums()
  {
    return $this->belongsToMany(Album::class, 'album_collapsible_element');
  }
}
