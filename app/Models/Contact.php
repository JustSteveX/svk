<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['title', 'firstname', 'lastname', 'email', 'phonenumber', 'sort_order'];
}
