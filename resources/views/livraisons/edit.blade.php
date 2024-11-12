@extends('base')

@section('title', 'livraisons / Modifier')

@section('content')
    <h4>livraisons / Modifier</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une livraison</h4>

                <!-- Afficher les messages de succès ou d'erreur -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST" class="form-sample">
                    @csrf
                    @method('PUT')

                    <!-- Champ de sélection du produit -->
                    <div class="form-group">
                        <label for="products_id">Produit</label>
                        <select name="products_id" id="products_id" class="form-control" required>
                            <option value="">Sélectionner un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ $produit->id == $livraison->products_id ? 'selected' : '' }}>
                                    {{ $produit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Champ de sélection du client -->
                    <div class="form-group">
                        <label for="clients_id">Client</label>
                        <select name="clients_id" id="clients_id" class="form-control" required>
                            <option value="">--Sélectionnez un client--</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $client->id == $livraison->clients_id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label class="col-sm-3 col-form-label">Ville</label>
                    <select name="villes_id" class="form-control" required>
                        <option value="">Sélectionner une ville</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}" {{ $livraison->villes_id == $ville->id ? 'selected' : '' }}>
                                {{ $ville->name }}
                            </option>
                        @endforeach
                    </select>

                    <label class="col-sm-3 col-form-label">Véhicule</label>
                    <select name="transports_id" class="form-control" required>
                        <option value="">Sélectionner une Véhicule</option>
                        @foreach ($transports as $transport)
                            <option value="{{ $transport->id }}" {{ $livraison->transports_id == $transport->id ? 'selected' : '' }}>
                                {{ $transport->vehicule }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Champ pour la Date de Livraison -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Date de Livraison</label>
                        <input type="date" name="dateLivraison" class="form-control"
                            value="{{ old('dateLivraison', $livraison->dateLivraison) }}" required />
                    </div>

                    <!-- Champ pour le statut de la Livraison -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Statut de la Livraison</label>
                        <select name="statusLivraison" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours"
                                {{ old('statusLivraison', $livraison->statusLivraison) == 'en cours' ? 'selected' : '' }}>En
                                cours</option>
                            <option value="complétée"
                                {{ old('statusLivraison', $livraison->statusLivraison) == 'complétée' ? 'selected' : '' }}>
                                Expediée</option>
                            <option value="annulée"
                                {{ old('statusLivraison', $livraison->statusLivraison) == 'annulée' ? 'selected' : '' }}>
                                Annulée</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Modifier la livraison</button>
                    <a href="{{ route('livraisons.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
@endsection
