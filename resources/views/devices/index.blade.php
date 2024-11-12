@extends('base')

@section('content')
    <h4>Devises / Liste</h4>

    <a href="{{ route('devices.add') }}" class="btn btn-primary btn-sm">Ajouter une devise</a>
    <br><br>

    <!-- Barre de recherche -->
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une devise...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des Devises</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="deviceTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $device)
                                <tr>
                                    <td class="py-1">{{ $device->id }}</td>
                                    <td>{{ $device->name }}</td>
                                    <td>
                                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('devices.destroy', $device->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette devise ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $devices->currentPage() }} sur {{ $devices->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($devices->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $devices->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($devices->hasMorePages())
                                <a class="btn btn-primary" href="{{ $devices->nextPageUrl() }}">Suivant &raquo;</a>
                            @else
                                <button class="btn btn-secondary" disabled>Suivant &raquo;</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de recherche en temps réel -->
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            var value = this.value.toLowerCase();
            var rows = document.querySelectorAll('#deviceTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
