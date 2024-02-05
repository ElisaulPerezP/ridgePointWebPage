<x-app-layout>
    <x-slot name="slotHead">

    </x-slot>

    <x-slot name="slotMain">

        <section id="userShow" class="section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>User Details</h2>
                </div>

                <div class="row mt-4">
    <div class="col-lg-6">
        <div class="user-details" data-aos="fade-up" data-aos-delay="100">
            <h2>{{ $user->name }}</h2>

                @foreach($user->roles as $role)
                    <p>Rol: {{ $role->name }}</p>
                    <p>Permissions for {{ $role->name }}:</p>
                    <ul>
                        @foreach($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                @endforeach

                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
             </div>
        </div>
        <div class="col-lg-6">
            <div class="user-details" data-aos="fade-up" data-aos-delay="100">
                @if ($user->hasMedia('avatar_images'))
                    <img src="{{ $user->getFirstMediaUrl('avatar_images') }}" alt="User Avatar" class="mt-4">
                @else
                    <p class="mt-4">No Avatar Image</p>
                @endif
            </div>
        </div>

    </div>

            </div>
        </section>
    </x-slot>
</x-app-layout>
