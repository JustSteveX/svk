<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email', 'invitation_token', 'registered_at', 'role_id',
    ];

    public function generateInvitationToken()
    {
        $this->invitation_token = substr(md5(rand(0, 9).$this->email.time()), 0, 32);
    }

    public function isNotRegistered()
    {
        return $this->registered_at === null;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function regenerateToken()
    {
        $this->generateInvitationToken();
        $this->save();

        return $this->token;
    }
}
