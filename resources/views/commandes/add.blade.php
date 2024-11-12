@extends('base')

@section('title', 'Commandes / Ajouter')

@section('content')
    <h4>Commandes / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter une commande</h4>

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

                <form class="form-sample" action="{{ route('commandes.store') }}" method="POST">
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

                    <!-- Champ de sélection du vendeur -->
                    <div class="form-group">
                        <label for="vendeur_id">Vendeur</label>
                        <select name="vendeur_id" id="vendeur_id" class="form-control" required>
                            <option value="">--Sélectionnez un vendeur--</option>
                            @foreach ($vendeurs as $vendeur)
                                <option value="{{ $vendeur->id }}">{{ $vendeur->name }}</option>
                            @endforeach
                        </select>
                        @error('vendeur_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ pour la date de commande -->
                    <div class="form-group">
                        <label for="dateCommande">Date de Commande</label>
                        <input type="date" name="dateCommande" id="dateCommande" class="form-control" required />
                        @error('dateCommande')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ pour le statut de la commande -->
                    <div class="form-group">
                        <label for="statusCommande">Statut de la Commande</label>
                        <select name="statusCommande" id="statusCommande" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours">En cours</option>
                            <option value="complétée">Complétée</option>
                            <option value="annulée">Annulée</option>
                        </select>
                        @error('statusCommande')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter la commande</button>
                </form>
            </div>
        </div>
    </div>
@endsection
