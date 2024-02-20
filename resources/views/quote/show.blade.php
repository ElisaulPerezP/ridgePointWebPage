<x-app-layout>
    <x-slot name="slotHead">
        <section id="showResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Details for <br> {{ $quote->name }}
                </div>
            </div>
        </section>
    </x-slot>

    <x-slot name="slotMain">
        <section id="showResource" class="get-started section-bg">
            <div class="container-fluid col-lg-9  text-left" data-aos="fade">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <h3 for="name">Name:</h3>
                        <p>{{ $quote->name }}</p>
                    </div>

                    <div class="col-md-12">
                        <h3 for="description">Description:</h3>
                        <p>{{ $quote->description }}</p>
                    </div>

                    <div class="col-md-12">
                        <h3 for="message">Message:</h3>
                        <p>{{ $quote->message }}</p>
                    </div>

                    <div class="col-md-12">
                        <h3 for="creation_date">Creation Date:</h3>
                        <p>{{ $quote->creation_date }}</p>
                    </div>

                    <div class="col-md-12">
                        <h3 for="creation_place">Creation Place:</h3>
                        <p>{{ $quote->creation_place }}</p>
                    </div>

                    <div class="col-md-12">
                        <h3 for="image_rights">Image Rights:</h3>
                        <p>{{ $quote->image_rights }}</p>
                    </div>

                    @if ($quote->hasMedia('quote_images'))
                        <div class="col-md-12 mt-4">
                            <h3>Image:</h3>
                            <img src="{{ $quote->getFirstMediaUrl('quote_images') }}" alt="quote Image">
                        </div>
                    @else
                        <div class="col-md-12 mt-4">
                            <p>No Image Available</p>
                        </div>
                    @endif

                    <div class="col-md-9 text-center mt-4">
                        @can('update', $quote)
                            <a href="{{ route('quotes.edit', $quote->id) }}" class="btn btn-secondary">Editar</a>
                        @endcan
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
