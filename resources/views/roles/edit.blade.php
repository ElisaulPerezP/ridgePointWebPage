<x-app-layout>
    <x-slot name="slotHead">
        <section id="editRoleMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Edit Role and Permissions: {{ $role->name }}
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="slotMain">
        <section id="editRole" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
                <form action="{{ route('roles.update', $role->id) }}" class="php-email-form" method="POST">
                    @csrf
                    @method('PUT')
                    <h3>Edit Role and Permissions</h3>

                    <div class="row gy-3">
                        <div class="col-md-12">
                            <label for="name">Role Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" placeholder="Enter role name">
                        </div>

                        <div class="col-md-12 mt-3 container">
                            <label for="permissions">Select Permissions:</label>
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input  type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <label for="{{ $permission->name }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-12 text-center mt-4">
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
        if (confirm("Are you sure you want to delete this Role?")) {
            document.getElementById('delete-form').submit();
        }
    }
</script>

<form id="delete-form" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>