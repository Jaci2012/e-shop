@extends('base')

@section('title', 'Achats / Ajouter')

@section('content')
    <h4>Achats / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un achat</h4>

                <!-- Afficher les messages de succès ou d'erreur -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="form-sample" action="{{ route('achats.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Produit</label>
                        <select name="products_id" class="form-control" required>
                            <option value="">--Sélectionnez un produit--</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Client</label>
                        <select name="clients_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Quantité</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Entrez la quantité"
                            required />
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
