<x-app-layout>
    @slot('slotHead')
        <section id="editResourceMessage" class="info">
        
        </section>
    @endslot

    @slot('slotMain')
        <section id="indexResourceIndex">
            <div class="container mx-auto">
                <section id="editResourceMessage" class="info">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 text-center">
                                <div class="info">
                                    <h1>Roles Index</h1>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center">
                                <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New Role</a>
                            </div>
                        </div>
                    </div>
                </section>
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
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $role->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endslot
</x-app-layout>
