@extends('base')

<title>Produits / Modifier</title>

@section('content')
    <h4>Produits / Modifier</h4>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un produit</h4>
                <form class="form-sample" action="{{ route('produits.update', $produit->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="image">Image du produit</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="form-text text-muted">
                            Formats acceptés : jpeg, png, jpg, gif, svg, webp. Taille maximale : 2MB.
                        </small>
                        <br>
                        @if ($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" target="_blank" alt="Image du produit"
                                width="100">
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Nom de produit</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $produit->name) }}" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Catégorie</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $produit->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->designation }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <select name="type_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $produit->type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <input type="text" name="desc" class="form-control" value="{{ old('desc', $produit->desc) }}" placeholder="" />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Prix Unitaire</label>
                        <input type="number" name="prixUnit" class="form-control" value="{{ old('prixUnit', $produit->prixUnit) }}" required />
                    </div>

                    <div class="form-group">
                        <label for="devise_id">Devise</label>
                        <select name="devise_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($devices as $devise)
                                <option value="{{ $devise->id }}"
                                    {{ $produit->devise_id == $devise->id ? 'selected' : '' }}>
                                    {{ $devise->name }}
                                </option>
                            @endforeach
                        </select>
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
