<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;


class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }
    public function assignPermissionsToRole(Role $role): view
    {
        return view('roles.assignPermissions', ['resource_type' => 'role', 'id' => $role->id]);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index', $role->id)
            ->with('success', 'Role and permissions updated successfully');
    }
    public function create()
{
    $allPermissions = Permission::all();

    return view('roles.create', compact('allPermissions'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:roles|max:255',
    ]);

    $role = Role::create([
        'name' => $request->input('name'),
    ]);

    $role->syncPermissions($request->input('permissions', []));

    return redirect()->route('roles.index')
        ->with('success', 'Role created successfully');
}
public function destroy(Role $role)
{
    $usersWithRole = $role->users;

    if ($usersWithRole->isNotEmpty()) {
        return redirect()->route('roles.index')
            ->with('error', 'Cannot delete role. Users are assigned to this role. Reassign users before deleting.');
    }

    $role->delete();

    return redirect()->route('roles.index')
        ->with('success', 'Role deleted successfully');
}
}
