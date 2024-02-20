<x-app-layout>
    <x-slot name="slotHead">
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Create a new Quote
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
                <form action="{{ route('quotes.store') }}" id="quoteForm" class="php-email-form" method="POST" enctype="multipart/form-data">   
                    @csrf
                    <h3>Allow us to help you get an approximate idea of the price for your project.</h3>
                            <p>This application will allow you to obtain a quote in record time. To do so, you must follow the steps. Start by filling out the form displayed below.</p>
                            <p>The * marks the mandatory fields.<p>
                            <div class="row gy-3">
                            <div class="col-md-12">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name*"  value="{{ auth()->check() ? auth()->user()->name : '' }}">
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone*" value="{{ auth()->check() ? auth()->user()->phone : '' }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control"  id="description" name="description" placeholder="Description*">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" id="message" name="message" placeholder="Message">
                        </div>


                        <div class="col-md-12">
                            <input type="text" class="form-control" id="creation_place" name="creation_place" placeholder="Address*">
                        </div>

                        <div class="col-md-12">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>

                        <div id="imageRightsField" class="col-md-12" style="display: none;">
                            
                        <div style="border: 2px solid red; padding: 10px;">
                        <input type="checkbox" class="green-checkbox" id="image_rights" name="image_rights">
                            
                        <label for="image_rights">I am the owner of the rights to this image, I grant the rights to this image to Ridgpoint.</label>
                        </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">The Quote has been successfully created. Thank you!</div>

                            <button type="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
