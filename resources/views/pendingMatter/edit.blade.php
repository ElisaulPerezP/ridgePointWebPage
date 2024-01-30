<x-app-layout>
    <x-slot name="slotHead">
        <section id="editResourceMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Edit for {{ $pendingMatter->name }} asosiated task
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="slotMain">
        <section id="editResource" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
            <form action="{{ route('pendingMatters.update', $pendingMatter->id) }}" class="php-email-form" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3>Editing task</h3>
    <div class="row gy-3">
        <div class="col-md-12">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $pendingMatter->name }}" placeholder="Enter name">
        </div>

        <div class="col-md-12">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" value="{{ $pendingMatter->description }}" placeholder="Enter description">
        </div>

        <div class="col-md-12">
            <label for="message">Message:</label>
            <input type="text" class="form-control" name="message" value="{{ $pendingMatter->message }}" placeholder="Enter message">
        </div>

        <div class="col-md-12">
            <label for="creation_date">Creation Date:</label>
            <input type="text" class="form-control" name="creation_date" value="{{ $pendingMatter->creation_date }}" placeholder="Enter creation date">
        </div>

        <div class="col-md-12">
            <label for="creation_place">Creation Place:</label>
            <input type="text" class="form-control" name="creation_place" value="{{ $pendingMatter->creation_place }}" placeholder="Enter creation place">
        </div>

        <div class="col-md-12">
    <label for="client_id">Client:</label>
    <select name="client_id" class="form-control">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $pendingMatter->client_id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-12 mt-3">
    <label for="responsible_id">Responsible:</label>
    <select name="responsible_id" class="form-control">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $pendingMatter->responsible_id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

        <div class="col-md-12 text-center mt-4">
            <button type="submit">Submit</button>
            <button type="button" onclick="confirmDelete()">Delete</button>
        </div>
    </div>
</form>
            </div><!-- End Quote Form -->
        </section>
    </x-slot>
</x-app-layout>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this Pending Matter?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>

<!-- Agrega el siguiente formulario oculto para enviar la solicitud de eliminación -->
<form id="delete-form" action="{{ route('pendingMatters.destroy', $pendingMatter->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>