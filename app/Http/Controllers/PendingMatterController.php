<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendingMatterRequest;
use App\Http\Requests\UpdatePendingMatterRequest;
use App\Models\PendingMatter;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PendingMatterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingMatters = PendingMatter::all();
        return view('pendingMatter.index')->with('pendingMatters', $pendingMatters);
    }


    public function create()
    {
        $users = User::all();
        return view('pendingMatter.create', compact('users'));
    }


    public function store(StorePendingMatterRequest $request)
    {
        $pendingMatter = new PendingMatter();
        $pendingMatter->name = $request->input('name');
        $pendingMatter->description = $request->input('description');
        $pendingMatter->message = $request->input('message');
        $pendingMatter->creation_date = $request->input('creation_date');
        $pendingMatter->creation_place = $request->input('creation_place');
        $pendingMatter->client_id = $request->input('client_id');
        $pendingMatter->responsible_id = $request->input('responsible_id');

        $pendingMatter->save();

        return redirect()->route('pendingMatters.index')->with('success', 'Pending Matter created successfully');
    }


    public function show(PendingMatter $pendingMatter)
    {
        return view('pendingMatter.show')->with('pendingMatter', $pendingMatter);
    }

    public function edit(PendingMatter $pendingMatter)
    {
        $users = User::all(); 
        return view('pendingMatter.edit', compact('pendingMatter', 'users'));
    }


    public function update(UpdatePendingMatterRequest $request, PendingMatter $pendingMatter)
    {
        

        $pendingMatter->name = $request->input('name');
        $pendingMatter->description = $request->input('description');
        $pendingMatter->message = $request->input('message');
        $pendingMatter->creation_date = $request->input('creation_date');
        $pendingMatter->creation_place = $request->input('creation_place');
        $pendingMatter->client_id = $request->input('client_id');
        $pendingMatter->responsible_id = $request->input('responsible_id');


        $pendingMatter->save();

        return redirect()->route('pendingMatters.index')->with('success', 'Pending Matter updated successfully');
    }


    public function destroy(PendingMatter $pendingMatter)
    {
        $pendingMatter->delete();
        return redirect()->route('pendingMatters.index')->with('success', 'PendingMatter deleted successfully');
    }
}
