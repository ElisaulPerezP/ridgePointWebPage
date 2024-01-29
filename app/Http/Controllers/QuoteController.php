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
        $imagePath = $request->file('image')->store('cuote_images', 'public');

        $Quote = new Quote();
        $Quote->name = $request->input('name');
        $Quote->description = $request->input('description');
        $Quote->message = $request->input('message');
        $Quote->creation_date = $request->input('creation_date');
        $Quote->creation_place = $request->input('creation_place');
        $Quote->image_rights = $request->input('image_rights');

        $Quote->addMedia(storage_path("app/public/{$imagePath}"))->preservingOriginal()->toMediaCollection('quote_images');

        $Quote->save();

        return redirect()->intended(route('quotes.index'));
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
            $newImagePath = $request->file('image')->store('Quote_images', 'public');

            $Quote->clearMediaCollection('Quote_images');

            $Quote->addMedia(storage_path("app/public/{$newImagePath}"))->preservingOriginal()->toMediaCollection('Quote_images');
        }

        $Quote->name = $request->input('name');
        $Quote->description = $request->input('description');
        $Quote->message = $request->input('message');
        $Quote->creation_date = $request->input('creation_date');
        $Quote->creation_place = $request->input('creation_place');
        $Quote->image_rights = $request->input('image_rights');

        $Quote->save();

        return redirect()->route('quotes.index')->with('success', 'Quote updated successfully');
    }


    public function destroy(Quote $Quote)
    {
        if ($Quote->hasMedia('Quote_images')) {
            $Quote->getMedia('Quote_images')->each(function ($media) {
                Storage::delete($media->getPath());
            });
        }

        $Quote->delete();

        return redirect()->route('quotes.index')->with('success', 'Quote deleted successfully');
    }
}
