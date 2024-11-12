@extends('base')

@section('title', 'Paiements / Modifier')

@section('content')
    <h4>Paiements / Modifier</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une Paiement</h4>

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

                <form action="{{ route('paiements.update', $paiement->id) }}" method="POST" class="form-sample">
                    @csrf
                    @method('PUT')

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
                                <option value="{{ $produit->id }}"
                                    {{ $produit->id == $paiement->products_id ? 'selected' : '' }}>
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
                                    {{ $client->id == $paiement->clients_id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <!-- Champ pour la Date de Paiement -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Date de Paiement</label>
                        <input type="date" name="datePaiement" class="form-control"
                            value="{{ old('datePaiement', $paiement->datePaiement) }}" required />
                    </div>

                    <!-- Champ pour le statut de la Paiement -->
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label">Statut de la Paiement</label>
                        <select name="statusPaiement" class="form-control" required>
                            <option value="">--Sélectionnez un statut--</option>
                            <option value="en cours"
                                {{ old('statusPaiement', $paiement->statusPaiement) == 'en cours' ? 'selected' : '' }}>En
                                cours</option>
                            <option value="complétée"
                                {{ old('statusPaiement', $paiement->statusPaiement) == 'Payée' ? 'selected' : '' }}>
                                Payée</option>
                            <option value="annulée"
                                {{ old('statusPaiement', $paiement->statusPaiement) == 'refusée' ? 'selected' : '' }}>
                                refusée</option>
                        </select>
                    </div>


                    <br>
                    <button type="submit" class="btn btn-primary me-2">Modifier la Paiement</button>
                    <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </form>
            </div>
        </div>
    </div>
@endsection
