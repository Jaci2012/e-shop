@extends('base')

@section('title', 'Livraisons / Ajouter')

@section('content')
    <h4>Livraisons / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter une livraison</h4>

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

                <form class="form-sample" action="{{ route('livraisons.store') }}" method="POST">
                    @csrf

                    <!-- Champ de sélection du produit -->
                    <div class="form-group">
                        <label for="products_id">Produit</label>
                        <select name="products_id" id="products_id" class="form-control" required>
                            <option value="">Sélectionner un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                            @endforeach
                        </select>
                        @error('products_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ de sélection du client -->
                    <div class="form-group">
                        <label for="clients_id">Client</label>
                        <select name="clients_id" id="clients_id" class="form-control" required>
                            <option value="">--Sélectionnez un client--</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('clients_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="villes_id">Ville</label>
                    <select name="villes_id" class="form-control" required>
                        <option value="">Sélectionner une ville</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                        @endforeach
                    </select>

                    <label for="transports_id">Véhicule</label>
                    <select name="transports_id" class="form-control" required>
                        <option value="">Sélectionner une véhicule</option>
                        @foreach ($transports as $transport)
                            <option value="{{ $transport->id }}">{{ $transport->vehicule }}</option>
                        @endforeach
                    </select>

                    <!-- Champ pour la date de Livraison -->
                    <div class="form-group">
                        <label for="dateLivraison">Date de Livraison</label>
                        <input type="date" name="dateLivraison" id="dateLivraison" class="form-control" required />
                        @error('dateLivraison')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ pour le statut de Livraison -->
                    <div class="form-group">
                        <label for="statusLivraison">Statut de la Livraison</label>
                        <select name="statusLivraison" id="statusLivraison" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours">En cours</option>
                            <option value="complétée">Expedieé</option>
                            <option value="annulée">Annulée</option>
                        </select>
                        @error('statusLivraison')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter la Livraison</button>
                </form>
            </div>
        </div>
    </div>
@endsection
