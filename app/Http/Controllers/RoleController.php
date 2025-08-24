<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validPermissions = array_keys(config('permissions'));

        $request->validate([
          'id' => 'int|nullable|exists:roles,id',
          'name' => 'required|string',
          'permissions' => 'array',
          'permissions.*' => ['string', 'in:' . implode(',', $validPermissions)]
        ]);

        $role = Role::find($request->id);
        if(!$request->id){
          if(Role::where('rolename', $request->name)->exists()){
            return redirect()->back()->with('error', $request->name.' existiert bereits.');
          }
          $role = new Role;
          $role->rolename = $request->name;
        }

        $permissionsArray = $request->permissions;
        $permissionsBitmask = 0; // Initialisiere die Bitmaske mit 0

        // Berechne die Bitmaske
        foreach ($permissionsArray as $permissionName) {
            if (isset(config('permissions')[$permissionName])) {
                $permissionsBitmask |= config('permissions')[$permissionName]; // Füge das entsprechende Bit zur Bitmaske hinzu
            }
        }

        $role->permissions = $permissionsBitmask;
        $role->save();

        return redirect()->back()->with('success', 'Rollen erfolgreich gespeichert');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
