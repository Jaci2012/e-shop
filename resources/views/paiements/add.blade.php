@extends('base')

@section('title', 'Paiement / Ajouter')

@section('content')
    <h4>Paiements / Ajouter</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter une Paiement</h4>

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

                <form class="form-sample" action="{{ route('paiements.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Numéro de l'achat</label>
                        <select name="achats_id" class="form-control" required>
                            <option value="">--Sélectionnez--</option>
                            @foreach ($achats as $achat)
                                <option value="{{ $achat->id }}">{{ $achat->id }}</option>
                            @endforeach
                        </select>
                    </div>

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


                    <!-- Champ pour la date de Paiement -->
                    <div class="form-group">
                        <label for="datePaiement">Date de Paiement</label>
                        <input type="date" name="datePaiement" id="datePaiement" class="form-control" required />
                        @error('datePaiement')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ pour le statut de Paiement -->
                    <div class="form-group">
                        <label for="statusPaiement">Statut de la Paiement</label>
                        <select name="statusPaiement" id="statusPaiement" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours">En cours</option>
                            <option value="Payée">Payée</option>
                            <option value="refusée">refusée</option>
                        </select>
                        @error('statusLivraison')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter la Paiement</button>
                </form>
            </div>
        </div>
    </div>
@endsection
