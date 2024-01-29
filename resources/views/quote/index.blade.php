<x-app-layout>
    @slot('slotHead')
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle"
                    data-aos="fade-down">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carousels.index') }}">Carousels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('quotes.index') }}">quotes</a>
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
                        @foreach ($quotes as $quote)
                            <div class="bg-white p-4 rounded-md shadow-md" data-aos="fade-up">
                                <h2 class="text-lg font-semibold">{{ $quote->name }}</h2>
                                <p>{{ $quote->description }}</p>
                                <p>{{ $quote->message }}</p>
                                <p>{{ $quote->creation_date }}</p>
                                <p>{{ $quote->creation_place }}</p>
                                <p>{{ $quote->image_rights }}</p>

                                @if ($quote->hasMedia('quote_images'))
                                    <img src="{{ $quote->getFirstMediaUrl('quote_images') }}" alt="quote Image"
                                         class="mt-4">
                                @else
                                    <p class="mt-4">No Image</p>
                                @endif

                                <div class="mt-4">
                                    <a href="{{ route('quotes.edit', $quote->id) }}"
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
