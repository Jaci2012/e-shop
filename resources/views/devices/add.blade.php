@extends('base')

<title>Devises</title>

@section('content')
    <h4>Devises / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un devise</h4>
                <form class="form-sample" action="{{ route('devices.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Nom</label>
                    <input type="text" name="name" class="form-control"
                        placeholder="Ex: Euro" /><br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
