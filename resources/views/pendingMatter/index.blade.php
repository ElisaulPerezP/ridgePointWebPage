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
                    <h1>Pending Matters Index</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <a href="{{ route('pendingMatters.create') }}" class="btn btn-primary">Create New Task</a>
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
                    <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Responsible</th>
                    <th class="px-6 py-3 bg-gray-100"></th> <!-- Celda vacía para acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingMatters as $pendingMatter)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $pendingMatter->name }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $pendingMatter->description }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $pendingMatter->message }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $pendingMatter->client->name }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $pendingMatter->responsible->name }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <a href="{{ route('pendingMatters.edit', $pendingMatter->id) }}" class="text-blue-500 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
    @endslot
</x-app-layout>
