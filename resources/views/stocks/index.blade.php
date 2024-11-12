@extends('base')

@section('content')
    <h4>Stocks / Listes</h4>
    <a href="{{ route('stocks.add') }}" class="btn btn-primary btn-sm">Ajouter une stock</a>
    <br><br>

    <!-- Champ de recherche -->
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un stock...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des stocks</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="stockTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Date d'entrée</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $index => $stock)
                                <tr>
                                    <td>{{ $stock->id }}</td>
                                    <td>{{ $stock->produit ? $stock->produit->name : 'Produit introuvable' }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->date_entry }}</td>
                                    <td>
                                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $stocks->currentPage() }} sur {{ $stocks->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($stocks->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $stocks->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($stocks->hasMorePages())
                                <a class="btn btn-primary" href="{{ $stocks->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#stockTable tbody tr');

            rows.forEach(function(row) {
                var produit = row.cells[1].textContent.toLowerCase(); // Produit
                var quantity = row.cells[2].textContent.toLowerCase(); // Quantité
                var date_entry = row.cells[3].textContent.toLowerCase(); // Date d'entrée

                var isVisible = produit.includes(value) || quantity.includes(value) || date_entry.includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
