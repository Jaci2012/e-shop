@extends('base')

<title>Transport</title>

@section('content')
    <h4>Transport / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Transport</h4>
                <form action="{{ route('transports.update', $transport->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="col-sm-3 col-form-label">Type</label>
                    <input type="text" name="type" class="form-control" value="{{ $transport->type }}" required
                        placeholder="" /><br><br>

                    <label class="col-sm-3 col-form-label">Véhicule</label>
                    <input type="text" name="vehicule" class="form-control" value="{{ $transport->vehicule }}" required
                        placeholder="" /><br><br>

                    <label class="col-sm-3 col-form-label">Ville</label>
                    <select name="villes_id" class="form-control" required>
                        <option value="">Sélectionner une ville</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}" {{ $transport->villes_id == $ville->id ? 'selected' : '' }}>
                                {{ $ville->name }}
                            </option>
                        @endforeach
                    </select>
                    <br><br>

                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
