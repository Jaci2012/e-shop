@extends('base')

<title>Produits / Ajouter</title>

@section('content')
    <h4>Produits / Ajouter</h4>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un produit</h4>
                <form class="form-sample" action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Image du produit</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="form-text text-muted">
                            Formats acceptés : jpeg, png, jpg, gif, svg, webp. Taille maximale : 2MB.
                        </small>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Nom du produit</label>
                        <input type="text" name="name" class="form-control" placeholder="" required />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Catégorie</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($categories as $categor)
                                <option value="{{ $categor->id }}">{{ $categor->designation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <select name="type_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <input type="text" name="desc" class="form-control" placeholder="" required />
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Prix unitaire</label>
                        <input type="number" name="prixUnit" class="form-control" placeholder="Entrez le Prix unitaire" required />
                    </div>

                    <div class="form-group">
                        <label for="devise_id">Devise</label>
                        <select name="devise_id" class="form-control" required>
                            @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }}</option>
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
