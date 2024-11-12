@extends('base')

@section('content')
    <h4>Vendeurs / Liste</h4>

    <a href="{{ route('vendeurs.add') }}" class="btn btn-primary btn-sm">Ajouter de vendeur</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un vendeur...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des vendeurs</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="vendeurTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nom de vendeur</th>
                                <th>Adresse</th>
                                <th>Numéro Tel</th>
                                <th>Rôle</th>
                                <th>E-mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendeurs as $vendeur)
                                <tr>
                                    <td class="py-1">{{ $vendeur->id }}</td>
                                    <td>{{ $vendeur->name }}</td>
                                    <td>{{ $vendeur->adresse }}</td>
                                    <td>{{ $vendeur->numero }}</td>
                                    <td>{{ $vendeur->role->role }}</td>
                                    <td>{{ $vendeur->email }}</td>
                                    <td>
                                        <a href="{{ route('vendeurs.edit', $vendeur->id) }}" class="btn btn-primary btn-sm">
                                            Modifier
                                        </a>
                                        <form action="{{ route('vendeurs.destroy', $vendeur->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce vendeur ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $vendeurs->currentPage() }} sur {{ $vendeurs->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($vendeurs->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $vendeurs->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($vendeurs->hasMorePages())
                                <a class="btn btn-primary" href="{{ $vendeurs->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#vendeurTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
