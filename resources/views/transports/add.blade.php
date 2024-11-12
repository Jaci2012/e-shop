@extends('base')

<title>Transport</title>

@section('content')
    <h4>Transport / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un Transport</h4>
                <form class="form-sample" action="{{ route('transports.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Type</label>
                    <input type="text" name="type" class="form-control" placeholder="" required /><br><br>

                    <label class="col-sm-3 col-form-label">Véhicule</label>
                    <input type="text" name="vehicule" class="form-control" placeholder="" required /><br><br>

                    <label for="villes_id">Ville</label>
                    <select name="villes_id" class="form-control" required>
                        <option value="">Sélectionner une ville</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                        @endforeach
                    </select>
                    <br><br> <!-- Ajout d'un espace supplémentaire -->

                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
