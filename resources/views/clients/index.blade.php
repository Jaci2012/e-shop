@extends('base')

@section('content')
    <h4>Clients / Liste</h4>
    <a href="{{ route('clients.add') }}" class="btn btn-primary btn-sm">Ajouter un client</a>

    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un client...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des clients</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="clientTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nom du Client</th>
                                <th>Adresse</th>
                                <th>Numéro Tel</th>
                                <th>Types</th>
                                <th>E-mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="py-1">{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->adresse }}</td>
                                    <td>{{ $client->numero }}</td>
                                    <td>{{ $client->role->role }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $clients->currentPage() }} sur {{ $clients->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($clients->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $clients->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($clients->hasMorePages())
                                <a class="btn btn-primary" href="{{ $clients->nextPageUrl() }}">Suivant &raquo;</a>
                            @else
                                <button class="btn btn-secondary" disabled>Suivant &raquo;</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            var value = this.value.toLowerCase();
            var rows = document.querySelectorAll('#clientTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
