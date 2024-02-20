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
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="col-lg-5 container" data-aos="fade">
                <form action="{{ route('quotes.update', $quote->id) }}" id="quoteForm" class="php-email-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3>Editing image</h3>
                    <p>Be cautious, the changes made to the image are not reversible. fields whith * cant be null</p>
                    <div class="row gy-3">
                        <div class="col-md-12">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $quote->name }}"  id="name" placeholder="Name*">
                        </div>

                        <div class="col-md-12">
                            <label for="name">Phone:</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $quote->phone }}" placeholder="Phone*">
                        </div>


                        <div class="col-md-12">
                            <label for="name">Email:</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ $quote->email }}" placeholder="Email">
                        </div>

                        <div class="col-md-12">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" value="{{ $quote->description }}" id="description" name="description" placeholder="Description*">
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message:</label>
                            <input type="text" class="form-control" value="{{ $quote->message }}" id="message" name="message" placeholder="Message">
                        </div>

                        <div class="col-md-12">
                            <label for="creation_date">Creation Date:</label>
                            <input type="text" class="form-control" value="{{ $quote->creation_date }}" name="creation_date" value="{{ $quote->creation_date }}" placeholder="Enter creation date">
                        </div>

                        <div class="col-md-12">
                            <label for="creation_place">Creation Place:</label>
                            <input type="text" class="form-control" value="{{ $quote->creation_place }}" id="creation_place" name="creation_place" placeholder="Address*">
                        </div>


                        <div class="col-md-12">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" value="{{ $quote->image }}" id="image" name="image" accept="image/*">
                        </div>


                        <div id="imageRightsField" class="col-md-12" style="display: none;">
                            
                            <div style="border: 2px solid red; padding: 10px;">
                            <input type="checkbox" class="green-checkbox" value="{{ $quote->name }}" id="image_rights" name="image_rights">
                                
                            <label for="image_rights">I am the owner of the rights to this image, I grant the rights to this image to Ridgpoint.</label>
                            </div>
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