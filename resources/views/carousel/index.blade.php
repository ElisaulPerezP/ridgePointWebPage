<x-app-layout>
    @slot('slotHead')
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle"
                    data-aos="fade-down">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Carousels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quotes.index') }}">quotes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                        </ul>
                </div>
            </div>
        </section>
    @endslot
    @slot('slotMain')
        <section id="editResourceIndex">
            <div>
            <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center">
                <div class="info">
                    <h1>Carousels Pothos Index</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <a href="{{ route('carousels.create') }}" class="btn btn-primary">Create New Carousel</a>
            </div>
        </div>
    </div>
                <table>
                    <tbody>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($carousels as $carousel)
                            <div class="bg-white p-4 rounded-md shadow-md" data-aos="fade-up">
                                <h2 class="text-lg font-semibold">{{ $carousel->name }}</h2>
                                <p>{{ $carousel->description }}</p>
                                <p>{{ $carousel->message }}</p>
                                <p>{{ $carousel->creation_date }}</p>
                                <p>{{ $carousel->creation_place }}</p>
                                <p>{{ $carousel->image_rights }}</p>

                                @if ($carousel->hasMedia('carousel_images'))
                                    <img src="{{ $carousel->getFirstMediaUrl('carousel_images') }}" alt="Carousel Image"
                                         class="mt-4">
                                @else
                                    <p class="mt-4">No Image</p>
                                @endif

                                <div class="mt-4">
                                    <a href="{{ route('carousels.edit', $carousel->id) }}"
                                       class="text-blue-500 hover:underline">Editar</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </tbody>
                </table>
            </div>
        </section>
    @endslot
</x-app-layout>
