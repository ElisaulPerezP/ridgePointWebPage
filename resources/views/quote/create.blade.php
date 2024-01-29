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
            <div class="col-lg-5" data-aos="fade">
                <form action="{{ route('quotes.store') }}" class="php-email-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3>Creating a new Quote</h3>
                    <p>Fill in the details for the new Quote.</p>
                    <div class="row gy-3">

                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="description" placeholder="Description">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="message" placeholder="Message">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="creation_date" placeholder="Creation Date">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="creation_place" placeholder="Creation Place">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="image_rights" placeholder="Image Rights">
                        </div>

                        <label for="image">Image:</label>
                        <input type="file" class="form-control" name="image" accept="image/*">

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
