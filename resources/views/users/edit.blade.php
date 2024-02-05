<x-app-layout>
    <x-slot name="slotHead">
        <section id="editUserMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Edit User Roles for {{ $usuario->name }}
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="slotMain">
        <section id="editUser" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
                <form action="{{ route('users.update', $usuario->id) }}" class="php-email-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3>Edit User Roles</h3>
                    
                    <div class="row gy-3">
                        <div class="col-md-12">
                            <label for="name">User Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" placeholder="Enter user name">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="roles">Select Roles:</label>
                            <select name="roles[]" class="form-control" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        @if ($usuario->hasMedia('avatar_images'))
                            <div class="col-md-12 mt-4">
                                <p>Original Image:</p>
                                <img src="{{ $usuario->getFirstMediaUrl('avatar_images') }}" alt="avatar Image">
                                <p>{{ $usuario->caption }}</p>
                            </div>
                        @else
                            <div class="col-md-12 mt-4">
                                <p>No Original Image</p>
                            </div>
                        @endif

                        @if (request()->hasFile('image'))
                            <div class="col-md-12 mt-4">
                                <p>New Image Preview:</p>
                                <img src="{{ URL::asset('path-to-your-temporary-image') }}" alt="New user Image">
                                <p>New Caption: {{ request()->input('new_caption') }}</p>
                            </div>

                        @endif

                        <div class="col-md-12 text-center mt-4">
                            <button type="submit">Submit</button>
                            <button type="button" onclick="confirmDelete()">Delete</button>
                        </div>
                    </div>
                </form>
                <form id="delete-form" action="{{ route('users.destroy', $usuario->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
<form id="delete-form" action="{{ route('users.destroy', $usuario->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>