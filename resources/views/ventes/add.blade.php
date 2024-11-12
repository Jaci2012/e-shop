@extends('base')

<title>Ventes / Ajouter</title>

@section('content')
    <h4>Vente / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter une vente</h4>
                <form class="form-sample" action="{{ route('ventes.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Produit</label>
                        <select name="products_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
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

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
