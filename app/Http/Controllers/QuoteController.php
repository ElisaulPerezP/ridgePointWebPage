<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Quotes = Quote::all();
        return view('quote.index')->with('quotes', $Quotes);
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

        if ($request->has('phone')) {
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

        return redirect()->intended(route('quotes.index'))->with('success', 'Your quote request has been successfully created. We will contact you as soon as possible.');
    }


    public function show(Quote $quote)
    {
        return view('quote.show')->with('quote', $quote);
    }

    public function edit(Quote $quote)
    {
        return view('quote.edit')->with('quote', $quote);
    }


    public function update(UpdateQuoteRequest $request, Quote $Quote)
    {
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
        if ($Quote->hasMedia('quote_images')) {
            $Quote->getMedia('quote_images')->each(function ($media) {
                Storage::delete($media->getPath());
            });
        }

        $Quote->delete();

        return redirect()->route('quotes.index')->with('success', 'Quote deleted successfully');
    }
}
