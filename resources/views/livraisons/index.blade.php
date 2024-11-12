@extends('base')

@section('content')
    <h4>Livraisons / Liste</h4>
    <a href="{{ route('livraisons.add') }}" class="btn btn-primary btn-sm">Ajouter une livraison</a>
    <br><br>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une livraison...">
    </div>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des livraisons</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="livraisonTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Client(Adresse)/(Numéro Tel)/(E-mail)</th>
                                <th>Ville (Code Postal)</th>
                                <th>Véhicule (Type de Transport)</th>
                                <th>Date de Livraison</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livraisons as $livraison)
                                <tr>
                                    <td class="py-1">{{ $livraison->id }}</td>
                                    <td>{{ $livraison->produit->name ?? 'Produit non disponible' }}</td>
                                    <td>{{ $livraison->client ? $livraison->client->name : 'Pas de client' }}
                                        ({{ $livraison->client ? $livraison->client->adresse : 'Pas de adresse' }})
                                        ({{ $livraison->client ? $livraison->client->numero : 'Pas de numero' }})
                                        ({{ $livraison->client ? $livraison->client->email : 'Pas  de email' }})
                                    </td>
                                    <td>
                                        {{ $livraison->ville ? $livraison->ville->name : 'Aucune' }}
                                        ({{ $livraison->ville ? $livraison->ville->cp : 'N/A' }})
                                    </td>

                                    <td>
                                        {{ $livraison->transport ? $livraison->transport->vehicule : 'Aucune' }}
                                        ({{ $livraison->transport ? $livraison->transport->type : 'N/A' }})
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($livraison->dateLivraison)->format('d/m/Y') }}</td>
                                    <td>{{ ucfirst($livraison->statusLivraison) }}</td>
                                    <td>
                                        <a href="{{ route('livraisons.edit', $livraison->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('livraisons.destroy', $livraison->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette livraison ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $livraisons->currentPage() }} sur {{ $livraisons->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($livraisons->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $livraisons->previousPageUrl() }}">&laquo;
                                    Précédent</a>
                            @endif

                            @if ($livraisons->hasMorePages())
                                <a class="btn btn-primary" href="{{ $livraisons->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#livraisonTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
