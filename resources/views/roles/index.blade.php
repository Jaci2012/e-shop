@extends('base')

@section('content')
    <h4>Rôles / Liste</h4>

    <a href="{{ route('roles.add') }}" class="btn btn-primary btn-sm">Ajouter une rôle</a>
    <br><br>

    <!-- Barre de recherche -->
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un rôle...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des rôles</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="roleTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Rôle d'utilisateur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rols as $role)
                                <tr>
                                    <td class="py-1">{{ $role->id }}</td>
                                    <td>{{ $role->role }}</td>
                                    <td>
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>

                                        <!-- Formulaire de suppression -->
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $rols->currentPage() }} sur {{ $rols->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($rols->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $rols->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($rols->hasMorePages())
                                <a class="btn btn-primary" href="{{ $rols->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#roleTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
