@extends('base')

@section('content')
    <h4>Transports / Liste</h4>

    <a href="{{ route('transports.add') }}" class="btn btn-primary btn-sm">Ajouter une transport</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un transport...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des transports</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="transportTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Type</th>
                                <th>Véhicule</th>
                                <th>Ville (Code Postal)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transports as $transport)
                                <tr>
                                    <td class="py-1">{{ $transport->id }}</td>
                                    <td>{{ $transport->type }}</td>
                                    <td>{{ $transport->vehicule }}</td>
                                    <td>
                                        {{ $transport->ville ? $transport->ville->name : 'Aucune' }}
                                        ({{ $transport->ville ? $transport->ville->cp : 'N/A' }})
                                    </td>
                                    <td>
                                        <a href="{{ route('transports.edit', $transport->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('transports.destroy', $transport->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce transport ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $transports->currentPage() }} sur {{ $transports->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($transports->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $transports->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($transports->hasMorePages())
                                <a class="btn btn-primary" href="{{ $transports->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#transportTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
