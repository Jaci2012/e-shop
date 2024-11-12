@extends('base')

@section('content')
    <h4>Catégories / Liste</h4>

    <a href="{{ route('categories.add') }}" class="btn btn-primary btn-sm">Ajouter une catégorie</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une catégorie..." value="{{ request('search') }}">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des catégories</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="categoryTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Désignation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="py-1">{{ $category->id }}</td>
                                    <td>{{ $category->designation }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $categories->currentPage() }} sur {{ $categories->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($categories->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $categories->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($categories->hasMorePages())
                                <a class="btn btn-primary" href="{{ $categories->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#categoryTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
