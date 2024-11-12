@extends('base')

@section('content')
    <h4>Stocks / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un stock</h4>
                <form class="form-sample" action="{{ route('stocks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Produit</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Quantité</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Entrez la quantité" required />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Date d'entrée</label>
                        <input type="date" name="date_entry" class="form-control" required />
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
