<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (Auth::user()->can('viewAny', Quote::class)) {
        if (Auth::user()->hasRole('admin')) {
            // Si el usuario tiene el rol de administrador, obtén todas las citas
            $quotes = Quote::all();
        } else {
            // Si el usuario no es administrador, obtén solo las citas asociadas a su correo electrónico
            $quotes = Quote::where('email', Auth::user()->email)->get();
        }
    
        return view('quote.index', compact('quotes'));
    } else {
        abort(403, 'Unauthorized action.');
    }
}


    public function create()
    {
        return view('quote.create');
    }


    public function store(StoreQuoteRequest $request)
    {
        $Quote = new Quote();
        $Quote->name = $request->input('name');
        $Quote->phone = $request->input('phone');

        if ($request->has('email')) {
            $Quote->email = $request->input('email');
        }

        $Quote->description = $request->input('description');
        $Quote->message = $request->input('message');
        $Quote->creation_date = $request->input('creation_date');
        $Quote->creation_place = $request->input('creation_place');

        if ($request->has('response_date')) {
            $Quote->response_date = $request->input('response_date');
        }

        if ($request->has('response_message')) {
            $Quote->response_message = $request->input('response_message');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quote_images', 'public');
            $Quote->addMedia(storage_path("app/public/{$imagePath}"))->preservingOriginal()->toMediaCollection('quote_images');
            $Quote->image_rights = $request->input('image_rights');
        }

        $Quote->save();

        if (Auth::check()) {
            return redirect()->route('quotes.index')->with('success', 'Your quote request was submitted successfully. You can view your requests and their status here.');
        } else {
            return redirect()->route('login')->with('success', 'Your quote request was submitted successfully. To track it, please log in by creating a new account or access it through your Google account for faster processing.');
        }
    }


    public function show(Quote $quote)
    {
        $this->authorize('view', $quote);
        return view('quote.show')->with('quote', $quote);
    }

    public function edit(Quote $quote)
    {
        $this->authorize('update', $quote);
        return view('quote.edit')->with('quote', $quote);
    }


    public function update(UpdateQuoteRequest $request, Quote $Quote)
    {
        $this->authorize('update', $Quote);
        if ($request->hasFile('image')) {
            $existingMedia = $Quote->getFirstMedia('quote_images');
        
            if ($existingMedia) {
                $existingMedia->delete();
            }
        
            $newImagePath = $request->file('image')->store('quote_images', 'public');
        
            $Quote->clearMediaCollection('quote_images');
        
            $Quote->addMedia(storage_path("app/public/{$newImagePath}"))->preservingOriginal()->toMediaCollection('quote_images');
            $Quote->image_rights = $request->input('image_rights');
        }

        $Quote->name = $request->input('name');

        if ($request->has('email')) {
            $Quote->email = $request->input('email');
        }

        $Quote->description = $request->input('description');
        
        if ($request->has('message')) {
            $Quote->message = $request->input('message');
        }

        $Quote->creation_date = $request->input('creation_date');
        $Quote->creation_place = $request->input('creation_place');
        
        if ($request->has('response_date')) {
            $Quote->response_date = $request->input('response_date');
        }

        if ($request->has('response_message')) {
            $Quote->response_message = $request->input('response_message');
        }

        $Quote->save();

        return redirect()->route('quotes.index')->with('success', 'Quote updated successfully');
    }


    public function destroy(Quote $Quote)
    {
        $this->authorize('delete', $Quote);
        if ($Quote->hasMedia('quote_images')) {
            $Quote->getMedia('quote_images')->each(function ($media) {
                Storage::delete($media->getPath());
            });
        }

        $Quote->delete();

        return redirect()->route('quotes.index')->with('success', 'Quote deleted successfully');
    }
}
