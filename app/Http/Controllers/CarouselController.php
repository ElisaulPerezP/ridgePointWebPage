<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::all();
        return view('carousel.index')->with('carousels', $carousels);
    }


    public function create()
    {
        return view('carousel.create');
    }


    public function store(StoreCarouselRequest $request)
    {
        $imagePath = $request->file('image')->store('carousel_images', 'public');

        $carousel = new Carousel();
        $carousel->name = $request->input('name');
        $carousel->description = $request->input('description');
        $carousel->message = $request->input('message');
        $carousel->creation_date = $request->input('creation_date');
        $carousel->creation_place = $request->input('creation_place');
        $carousel->image_rights = $request->input('image_rights');

        $carousel->addMedia(storage_path("app/public/{$imagePath}"))->preservingOriginal()->toMediaCollection('carousel_images');

        $carousel->save();

        return redirect()->route('carousels.index')->with('success', 'Carousel created successfully');
    }


    public function show(Carousel $carousel)
    {
        return view('carousel.show')->with('carousel', $carousel);
    }

    public function edit(Carousel $carousel)
    {
        return view('carousel.edit')->with('carousel', $carousel);
    }


    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('carousel_images', 'public');

            $carousel->clearMediaCollection('carousel_images');

            $carousel->addMedia(storage_path("app/public/{$newImagePath}"))->preservingOriginal()->toMediaCollection('carousel_images');
        }

        $carousel->name = $request->input('name');
        $carousel->description = $request->input('description');
        $carousel->message = $request->input('message');
        $carousel->creation_date = $request->input('creation_date');
        $carousel->creation_place = $request->input('creation_place');
        $carousel->image_rights = $request->input('image_rights');

        $carousel->save();

        return redirect()->route('carousels.index')->with('success', 'Carousel updated successfully');
    }


    public function destroy(Carousel $carousel)
    {
        if ($carousel->hasMedia('carousel_images')) {
            $carousel->getMedia('carousel_images')->each(function ($media) {
                Storage::delete($media->getPath());
            });
        }

        $carousel->delete();

        return redirect()->route('carousels.index')->with('success', 'Carousel deleted successfully');
    }
}
