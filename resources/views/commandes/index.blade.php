@extends('base')

@section('content')
    <h4>Commandes / Liste</h4>
    <a href="{{ route('commandes.add') }}" class="btn btn-primary btn-sm">Ajouter une commande</a>
    <br><br>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une commande...">
    </div>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des commandes</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="commandeTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Client</th> <!-- Nouvelle colonne pour le client -->
                                <th>Vendeur</th>
                                <th>Date de Commande</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $index => $commande)
                                <tr>
                                    <td class="py-1">{{ $commande->id }}</td>
                                    <td>{{ $commande->produit->name ?? 'Produit non disponible' }}</td>
                                    <td>{{ $commande->client ? $commande->client->name : 'Pas de client' }}</td>
                                    <!-- Nom du client -->
                                    <td>{{ $commande->vendeur ? $commande->vendeur->name : 'Pas de vendeur' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($commande->dateCommande)->format('d/m/Y') }}</td>
                                    <td>{{ ucfirst($commande->statusCommande) }}</td>
                                    <td>
                                        <a href="{{ route('commandes.edit', $commande->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $commandes->currentPage() }} sur {{ $commandes->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($commandes->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $commandes->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($commandes->hasMorePages())
                                <a class="btn btn-primary" href="{{ $commandes->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#commandeTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
