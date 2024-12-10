<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rolename',
        'permissions'
    ];

    public function addPermission(string $permission)
    {
        $permissions = config('permissions');
        if (isset($permissions[$permission])) {
            $this->permissions |= $permissions[$permission]; // Bit setzen
            $this->save();
        }
    }

    // Berechtigung entfernen
    public function removePermission(string $permission)
    {
        $permissions = config('permissions');
        if (isset($permissions[$permission])) {
            $this->permissions &= ~$permissions[$permission]; // Bit löschen
            $this->save();
        }
    }

    // Prüfen, ob eine Berechtigung vorhanden ist
    public function hasPermission(string $permission)
    {

        // Überprüfe, ob die angeforderte Berechtigung im Array der Berechtigungen vorhanden ist
        return in_array($permission, $this->permissions);
    }

    public function getPermissionsAttribute()
    {
        // Lade die Permission-Konfiguration
        $permissionsConfig = config('permissions');

        // Extrahiere die Namen basierend auf der Bitmaske
        return collect($permissionsConfig)
            ->filter(fn($bit) => ($this->attributes['permissions'] & $bit) === $bit)
            ->keys()
            ->toArray();
    }
}
