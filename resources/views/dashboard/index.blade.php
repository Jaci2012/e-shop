@extends('base')

@section('content')
<div class="container">
    <div class="row">
        @if ($role->role == 'Administrateur')
            <!-- Cartes pour l'administrateur -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="menu-icon mdi mdi-account-multiple-plus-outline"></i>
                            <span class="menu-title">Clients</span>
                        </h5>
                        <p class="card-text" style="font-size: 24px;">
                            {{ $data['clients']->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="menu-icon mdi mdi-cart-outline"></i>
                            <span class="menu-title">Vendeurs</span>
                        </h5>
                        <p class="card-text" style="font-size: 24px;">
                            {{ $data['vendeurs']->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ajoutez les autres cartes ici pour l'administrateur -->

        @elseif ($role->role == 'Vendeur')
            <!-- Informations pour le vendeur -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de Ventes</h5>
                        <p class="card-text" style="font-size: 24px;">{{ $data['ventes'] }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Profil</h5>
                        <p class="card-text"><strong>Nom:</strong> {{ $data['profile']->name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $data['profile']->email }}</p>
                        <p class="card-text"><strong>Adresse:</strong> {{ $data['profile']->adresse }}</p>
                        <p class="card-text"><strong>Numero:</strong> {{ $data['profile']->numero }}</p>
                    </div>
                </div>
            </div>


            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de Produits</h5>
                        <p class="card-text" style="font-size: 24px;">{{ $data['produits'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Ajoutez d'autres informations pertinentes pour le vendeur -->

        @elseif ($role->role == 'Acheteur')
            <!-- Informations pour l'acheteur -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Profil</h5>
                        <p class="card-text"><strong>Nom:</strong> {{ $data['profile']->name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $data['profile']->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Ajoutez les cartes pour les informations pertinentes de l'acheteur -->
        @endif
    </div>
</div>
@endsection
