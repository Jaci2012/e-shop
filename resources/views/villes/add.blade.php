@extends('base')

<title>Villes</title>

@section('content')
    <h4>Villes / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un ville</h4>
                <form class="form-sample" action="{{ route('villes.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Ville</label>
                    <input type="text" name="name" class="form-control" placeholder="" />
                    <label class="col-sm-3 col-form-label">Code postal</label>
                    <input type="text" name="cp" class="form-control" placeholder="" />
                    <br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
