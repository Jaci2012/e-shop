@extends('base')

@section('content')
    <h4>Stocks / Modifier</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Stock</h4>
                <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Produit</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ $stock->product_id == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Quantité</label>
                        <input type="number" name="quantity" class="form-control"
                            value="{{ old('quantity', $stock->quantity) }}" required />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Date d'entrée</label>
                        <input type="date" name="date_entry" class="form-control" value="{{ $stock->date_entry }}"
                            required />
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
