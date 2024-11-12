@extends('base')

@section('content')
    <h4>Produits / Listes</h4>
    <a href="{{ route('produits.add') }}" class="btn btn-primary btn-sm">Ajouter une produit</a>
    <br><br>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Rechercher un produit...">
    </div>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Listes des produits</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="productTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Nom du produit</th>
                                <th>Description</th>
                                <th>Catégorie</th>
                                <th>Type</th>
                                <th>Prix Unitaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="py-1">{{ $product->id }}</td>
                                    <td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" target="_blank"
                                                alt="Image du produit" width="100">
                                        @else
                                            Pas d'image
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->desc }}</td>
                                    <td>{{ $product->category ? $product->category->designation : 'Pas de catégorie' }}</td>
                                    <td>{{ $product->type ? $product->type->type : 'Pas de type' }}</td>
                                    <td>
                                        {{ $product->prixUnit }}
                                        {{ $product->devise
                                            ? ($product->devise->name == 'Ariary'
                                                ? 'Ar'
                                                : ($product->devise->name == 'Euro'
                                                    ? '€'
                                                    : ($product->devise->name == 'Dollars'
                                                        ? '$'
                                                        : $product->devise->name)))
                                            : 'Pas de devise' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('produits.edit', $product->id) }}"
                                            class="btn btn-primary btn-sm">Modifier</a>
                                        <form action="{{ route('produits.destroy', $product->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination personnalisée -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span>Page {{ $products->currentPage() }} sur {{ $products->lastPage() }}</span>
                        </div>
                        <div>
                            @if ($products->onFirstPage())
                                <button class="btn btn-secondary" disabled>&laquo; Précédent</button>
                            @else
                                <a class="btn btn-primary" href="{{ $products->previousPageUrl() }}">&laquo; Précédent</a>
                            @endif

                            @if ($products->hasMorePages())
                                <a class="btn btn-primary" href="{{ $products->nextPageUrl() }}">Suivant &raquo;</a>
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
            var rows = document.querySelectorAll('#productTable tbody tr');

            rows.forEach(function(row) {
                var isVisible = row.textContent.toLowerCase().includes(value);
                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
@endsection
