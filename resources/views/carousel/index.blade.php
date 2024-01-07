<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 dark:text-gray-200 leading-tight">
            CAROUSEL
        </h2>
    </x-slot>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Message</th>
            <th>Creation Date</th>
            <th>Creation Place</th>
            <th>Image Rights</th>
        </tr>
        </thead>
        <tbody>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($carousels as $carousel)
                <div class="bg-white p-4 rounded-md shadow-md">
                    <h2 class="text-lg font-semibold">{{ $carousel->name }}</h2>
                    <p>{{ $carousel->description }}</p>
                    <p>{{ $carousel->message }}</p>
                    <p>{{ $carousel->creation_date }}</p>
                    <p>{{ $carousel->creation_place }}</p>
                    <p>{{ $carousel->image_rights }}</p>

                    @if ($carousel->hasMedia('carousel_images'))
                        <img src="{{ $carousel->getFirstMediaUrl('carousel_images') }}" alt="Carousel Image" class="mt-4">
                    @else
                        <p class="mt-4">No Image</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('carousels.edit', $carousel->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    </div>
                </div>
            @endforeach
        </div>
        </tbody>
    </table>
</x-app-layout>
