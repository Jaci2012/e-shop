@extends('base')

@section('title', 'Commandes / Modifier')

@section('content')
    <h4>Commandes / Modifier</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une Commande</h4>

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

                <form action="{{ route('commandes.update', $commande->id) }}" method="POST" class="form-sample">
                    @csrf
                    @method('PUT')

                    <!-- Champ de sélection du produit -->
                    <div class="form-group">
                        <label for="products_id">Produit</label>
                        <select name="products_id" id="products_id" class="form-control" required>
                            <option value="">Sélectionner un produit</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ $produit->id == $commande->products_id ? 'selected' : '' }}>
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
                                    {{ $client->id == $commande->clients_id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Champ de sélection du vendeur -->
                    <label class="col-sm-3 col-form-label">Vendeur</label>
                    <select name="vendeur_id" class="form-control" required>
                        <option value="">--Sélectionnez un vendeur--</option>
                        @foreach ($vendeurs as $vendeur)
                            <option value="{{ $vendeur->id }}"
                                {{ $commande->vendeur_id == $vendeur->id ? 'selected' : '' }}>{{ $vendeur->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Champ pour la date de commande -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Date de Commande</label>
                        <input type="date" name="dateCommande" class="form-control"
                            value="{{ old('dateCommande', $commande->dateCommande) }}" required />
                    </div>

                    <!-- Champ pour le statut de la commande -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Statut de la Commande</label>
                        <select name="statusCommande" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours"
                                {{ old('statusCommande', $commande->statusCommande) == 'en cours' ? 'selected' : '' }}>En
                                cours</option>
                            <option value="complétée"
                                {{ old('statusCommande', $commande->statusCommande) == 'complétée' ? 'selected' : '' }}>
                                Complétée</option>
                            <option value="annulée"
                                {{ old('statusCommande', $commande->statusCommande) == 'annulée' ? 'selected' : '' }}>
                                Annulée</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Modifier la commande</button>
                    <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
@endsection
