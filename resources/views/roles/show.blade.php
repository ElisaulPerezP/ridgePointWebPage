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
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-fluid">
                            
                            <h2>{{ $user->name }}</h2>

                            @foreach($user->roles as $role)
                                <p>Rol: {{ $role->name }}</p>
                                <p>Permisos asociados a {{ $role->name }}:</p>
                                <ul>
                                    @foreach($role->permissions as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </ul>
                            @endforeach

                            <p>Todas las permissions aplicables al usuario:</p>
                            <ul>
                                @foreach($allPermissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>

                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
