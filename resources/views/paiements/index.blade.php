@extends('base')

@section('content')
    <h4>Paiements / Liste</h4>
    <a href="{{ route('paiements.add') }}" class="btn btn-primary btn-sm">Ajouter une Paiement</a>
    <br><br>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une paiement...">
    </div>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des Paiements</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="paiementTable">
                        <thead>
                            <tr>
                                <th>Numero d'Achat</th>
                                <th>Produit</th>
                                <th>Client / (E-mail)</th>
                                <th>Adresse</th>
                                <th>Date de Paiement</th>
                                <th>Prix Unitaire</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Facture</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payements as $payement)
                                <tr>
                                    <!-- Numero d'Achat -->
                                    <td>
                                        {{ $payement->achat ? $payement->achat->id : 'Pas d Achat' }}
                                    </td>

                                    <!-- Produit -->
                                    <td>
                                        {{ $payement->produit->name ?? 'Produit non disponible' }}
                                        ({{ $payement->achat->quantity }})
                                    </td>

                                    <!-- Client / (E-mail) -->
                                    <td>
                                        {{ $payement->client ? $payement->client->name : 'Pas de client' }}
                                        ({{ $payement->client ? $payement->client->email : 'Pas de email' }})
                                    </td>

                                    <td>{{ $payement->client ? $payement->client->adresse : 'Pas d adresse' }}</td>

                                    <!-- Date de Paiement -->
                                    <td>{{ \Carbon\Carbon::parse($payement->datePaiement)->format('d/m/Y') }}</td>

                                    <!-- Prix Unitaire avec Devise -->
                                    <td>
                                        {{ $payement->produit->prixUnit }}
                                        {{ $payement->produit && $payement->produit->devise
                                            ? ($payement->produit->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($payement->produit->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($payement->produit->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $payement->produit->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>

                                    <!-- Total -->
                                    <td>
                                        {{ number_format($payement->produit->prixUnit * ($payement->achat ? $payement->achat->quantity : 0), 2, ',', ' ') }}
                                        {{ $payement->produit && $payement->produit->devise
                                            ? ($payement->produit->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($payement->produit->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($payement->produit->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $payement->produit->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>

                                    <!-- Statut -->
                                    <td>{{ ucfirst($payement->statusPaiement) }}</td>
                                    <td>
                                        <a href="{{ route('paiements.facture', $payement->id) }}"
                                            class="btn btn-secondary">la facture PDF</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('paiements.edit', $payement->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('paiements.destroy', $payement->id) }}" method="POST"
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
                            <span>Page {{ $payements->currentPage() }} sur {{ $payements->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($payements->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $payements->previousPageUrl() }}">&laquo;
                                    Précédent</a>
                            @endif

                            @if ($payements->hasMorePages())
                                <a class="btn btn-primary" href="{{ $payements->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#paiementTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
