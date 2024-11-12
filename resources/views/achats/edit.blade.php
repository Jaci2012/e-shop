@extends('base')

@section('title', 'Achats / Modifier')

@section('content')
    <h4>Achats / Modifier</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Achat</h4>
                <form action="{{ route('achats.update', $achat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Sélection du produit -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Produit</label>
                        <select name="products_id" class="form-control" required>
                            <option value="">--Sélectionnez un produit--</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}" {{ $achat->products_id == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sélection du client -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Client</label>
                        <select name="clients_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ $achat->clients_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Quantité</label>
                        <input type="number" name="quantity" class="form-control"
                            value="{{ old('quantity', $achat->quantity) }}" required />
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
