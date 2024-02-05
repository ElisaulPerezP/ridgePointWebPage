<x-app-layout>
    <x-slot name="slotHead">
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Edit for {{ $quote->name }} image features
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="slotMain">
        <section id="editResource" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
                <form action="{{ route('quotes.update', $quote->id) }}" class="php-email-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3>Editing image</h3>
                    <p>Be cautious, the changes made to the image are not reversible.</p>
                    <div class="row gy-3">
                        <div class="col-md-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $quote->name }}" placeholder="Enter name">
                        </div>

                        <div class="col-md-12">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" value="{{ $quote->description }}" placeholder="Enter description">
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <input type="text" class="form-control" name="message" value="{{ $quote->message }}" placeholder="Enter message">
                        </div>

                        <div class="col-md-12">
                            <label for="creation_date">Creation Date:</label>
                            <input type="text" class="form-control" name="creation_date" value="{{ $quote->creation_date }}" placeholder="Enter creation date">
                        </div>

                        <div class="col-md-12">
                            <label for="creation_place">Creation Place:</label>
                            <input type="text" class="form-control" name="creation_place" value="{{ $quote->creation_place }}" placeholder="Enter creation place">
                        </div>

                        <div class="col-md-12">
                            <label for="image_rights">Image Rights:</label>
                            <input type="text" class="form-control" name="image_rights" value="{{ $quote->image_rights }}" placeholder="Enter image rights">
                        </div>

                        <div class="col-md-12">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>

                        @if ($quote->hasMedia('quote_images'))
                            <div class="col-md-12 mt-4">
                                <p>Original Image:</p>
                                <img src="{{ $quote->getFirstMediaUrl('quote_images') }}" alt="quote Image">
                                <p>{{ $quote->caption }}</p>
                            </div>
                        @else
                            <div class="col-md-12 mt-4">
                                <p>No Original Image</p>
                            </div>
                        @endif

                        @if (request()->hasFile('image'))
                            <div class="col-md-12 mt-4">
                                <p>New Image Preview:</p>
                                <img src="{{ URL::asset('path-to-your-temporary-image') }}" alt="New quote Image">
                                <p>New Caption: {{ request()->input('new_caption') }}</p>
                            </div>
                        @else
                            <div class="col-md-12 mt-4">
                                <p>No New Image Selected</p>
                            </div>
                        @endif

                        <div class="col-md-12 text-center mt-4">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">The image has been successfully edited. Thank you!</div>

                            <button type="submit">Submit</button>
                            <button type="button" onclick="confirmDelete()">Delete</button>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this quote?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>

<form id="delete-form" action="{{ route('quotes.destroy', $quote->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>