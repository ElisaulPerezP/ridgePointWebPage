<x-app-layout>
    <x-slot name="slotHead">
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Create a new Pending Matter
                </div>
            </div>
        </section>
    </x-slot>

    <x-slot name="slotMain">
        <section id="editResource" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
            <form action="{{ route('pendingMatters.store') }}" class="php-email-form" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row gy-3">
        <div class="col-md-12">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name">
        </div>

        <div class="col-md-12">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" placeholder="Enter description">
        </div>

        <div class="col-md-12">
            <label for="message">Message:</label>
            <input type="text" class="form-control" name="message" placeholder="Enter message">
        </div>

        <div class="col-md-12">
            <label for="creation_date">Creation Date:</label>
            <input type="text" class="form-control" name="creation_date" placeholder="Enter creation date">
        </div>

        <div class="col-md-12">
            <label for="creation_place">Creation Place:</label>
            <input type="text" class="form-control" name="creation_place" placeholder="Enter creation place">
        </div>

        <div class="col-md-12">
            <label for="client_id">Client:</label>
            <select name="client_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 mt-3">
            <label for="responsible_id">Responsible:</label>
            <select name="responsible_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 text-center mt-4">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">The task has been successfully created. Thank you!</div>

            <button type="submit">Submit</button>
        </div>
    </div>
</form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
