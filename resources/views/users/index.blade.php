<x-app-layout>
    <x-slot name="slotHead">
    </x-slot>

    <x-slot name="slotMain">
        <section id="userIndex" class="section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>User Index</h2>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('users.index') }}" method="GET" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control" 
                                                        id="search" name="search" placeholder="Search" 
                                                    value="{{ request('search') }}">
                                                </div>
                                                </div>
                                            <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row mt-4">
                    @foreach($users as $user)
                        <div class="col-lg-4 col-md-6">
                            <div class="user-box" data-aos="fade-up" data-aos-delay="100">
                                @if ($user->hasMedia('avatar_images'))
                                    <img src="{{ $user->getFirstMediaUrl('avatar_images') }}" alt="User Avatar"
                                         class="mt-4">
                                @else
                                <p class="mt-4">No Avatar Image</p>
                                @endif
                                <h3>{{ $user->name }}</h3>
                                <p>Email: {{ $user->email }}</p>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>