@extends('base')

@section('content')
    <h4>Ventes / Liste</h4>
    <a href="{{ route('ventes.add') }}" class="btn btn-primary btn-sm">Ajouter une vente</a>
    <br><br>

    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher une vente...">
    </div>
    <br>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des ventes</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="venteTable">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Prix Unitaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventes as $vent)
                                <tr>
                                    <td class="py-1">{{ $vent->id }}</td>
                                    <td>{{ $vent->produit ? $vent->produit->name : 'Pas de produit' }}</td>
                                    <td>{{ $vent->client ? $vent->client->name : 'Pas de client' }}</td>
                                    <td>
                                        {{ $vent->produit ? $vent->produit->prixUnit : 'N/A' }}
                                        {{ $vent->produit && $vent->produit->devise
                                            ? ($vent->produit->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($vent->produit->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($vent->produit->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $vent->produit->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>


                                    <td>
                                        <a href="{{ route('ventes.edit', $vent->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('ventes.destroy', $vent->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $ventes->currentPage() }} sur {{ $ventes->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($ventes->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $ventes->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($ventes->hasMorePages())
                                <a class="btn btn-primary" href="{{ $ventes->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#venteTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
