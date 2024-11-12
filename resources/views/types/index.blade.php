@extends('base')

@section('content')
    <h4>Types / Liste</h4>

    <a href="{{ route('types.add') }}" class="btn btn-primary btn-sm">Ajouter une type</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un type..."
            value="{{ request('search') }}">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des types</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="typeTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td class="py-1">{{ $type->id }}</td>
                                    <td>{{ $type->type }}</td>
                                    <td>
                                        <a href="{{ route('types.edit', $type->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('types.destroy', $type->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $types->currentPage() }} sur {{ $types->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($types->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $types->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($types->hasMorePages())
                                <a class="btn btn-primary" href="{{ $types->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#typeTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
