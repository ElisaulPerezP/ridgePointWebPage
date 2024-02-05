<x-app-layout>
    <x-slot name="slotHead">
        <section id="createRoleMessage" class="info">
            <div class="col-lg-6 text-center">
                <div class="subtitle" data-aos="fade-down">
                    Create a New Role
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="slotMain">
        <section id="createRole" class="get-started section-bg">
            <div class="col-lg-5" data-aos="fade">
                <form action="{{ route('roles.store') }}" class="php-email-form" method="POST">
                    @csrf
                    <h3>Create Role</h3>

                    <div class="row gy-3">
                        <div class="col-md-12">
                            <label for="name">Role Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter role name">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="permissions">Select Permissions:</label>
                            @foreach($allPermissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                    <label for="{{ $permission->name }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-12 text-center mt-4">
                            <button type="submit">Create Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>