@extends('base')

<title>Villes</title>

@section('content')
    <h4>Villes / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Ville</h4>
                <form action="{{ route('villes.update', $ville->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label">Nom de la ville</label>
                    <input type="text" name="name" class="form-control" value="{{ $ville->name }}" required>
                    <label class="col-sm-3 col-form-label">Code postal</label>
                    <input type="text" name="cp" class="form-control" value="{{ $ville->cp }}" required>
                    <br><br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
