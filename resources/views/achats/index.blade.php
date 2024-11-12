@extends('base')

@section('content')
    <h4>Achats / Listes</h4>
    <a href="{{ route('achats.add') }}" class="btn btn-primary btn-sm">Ajouter un achat</a>
    <br><br>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un achat...">
    </div>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des achats</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="achatTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Date d'achat</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire</th>
                                <th>Total</th> <!-- Nouvelle colonne Total -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($achats as $index => $achat)
                                <tr>
                                    <td class="py-1">{{ $achat->id }}</td>
                                    <td>{{ $achat->produit->name ?? 'Produit non disponible' }}</td>
                                    <td>{{ $achat->client ? $achat->client->name : 'Pas de client' }}</td>
                                    <td>{{ $achat->created_at->format('d/m/y') }}</td>
                                    <td>{{ $achat->quantity }}</td>
                                    <!-- Prix Unitaire avec Devise -->
                                    <td>
                                        {{ $achat->produit->prixUnit }}
                                        {{ $achat->produit && $achat->produit->devise
                                            ? ($achat->produit->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($achat->produit->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($achat->produit->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $achat->produit->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>
                                    </td>
                                    <td>
                                        <!-- Calcul du total = Prix Unitaire * Quantité -->
                                        {{ number_format($achat->produit->prixUnit * $achat->quantity, 2, ',', ' ') }}
                                        {{ $achat->produit && $achat->produit->devise
                                            ? ($achat->produit->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($achat->produit->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($achat->produit->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $achat->produit->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('achats.edit', $achat->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('achats.destroy', $achat->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet achat ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $achats->currentPage() }} sur {{ $achats->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($achats->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $achats->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($achats->hasMorePages())
                                <a class="btn btn-primary" href="{{ $achats->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#achatTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
