@extends('base')

@section('content')
    <h4>Villes / Liste</h4>

    <a href="{{ route('villes.add') }}" class="btn btn-primary btn-sm">Ajouter une ville</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une ville...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des villes</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="villeTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nom ville</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($villes as $ville)
                                <tr>
                                    <td class="py-1">{{ $ville->id }}</td>
                                    <td>{{ $ville->name }} ({{ $ville->cp }})</td>
                                    <td>
                                        <a href="{{ route('villes.edit', $ville->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ville ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $villes->currentPage() }} sur {{ $villes->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($villes->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $villes->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($villes->hasMorePages())
                                <a class="btn btn-primary" href="{{ $villes->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#villeTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
