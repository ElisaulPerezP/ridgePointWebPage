<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendingMatterRequest;
use App\Models\PendingMatter;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{

    public function index(Request $request)
    {

        $usersQuery = User::query();

        $search = $request->input('search');
        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');

        }


        $users = $usersQuery->paginate(10);

        return view('users.index', compact('users'));
    }


    public function show(User $user)
    {

        $user = $user->load('roles.permissions');
    
        $allPermissions = $user->getAllPermissions();

        return view('users.show', compact('user', 'allPermissions'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $existingMedia = $user->getFirstMedia('avatar_images');
    
            if ($existingMedia) {
                $existingMedia->delete();
            }
    
            $newImagePath = $request->file('image')->store('avatar_images', 'public');
            $user->clearMediaCollection('avatar_images');
            $user->addMedia(storage_path("app/public/{$newImagePath}"))->preservingOriginal()->toMediaCollection('avatar_images');
        }
    
        $user->update([
            'name' => $request->input('name'),
        ]);
    
        $user->syncRoles($request->input('roles', []));
    
        return redirect()->route('users.index')
            ->with('success', 'User roles and image updated successfully');
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('users.index')->with('error', 'Cannot delete user. Please reassign tasks before deleting.');
            }
            if ($user->hasMedia('avatar_images')) {
                $user->getMedia('avatar_images')->each(function ($media) {
                    Storage::delete($media->getPath());
                });
            }
            return redirect()->route('users.index')->with('error', 'Error deleting user.');
        }
    }
}
