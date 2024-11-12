@extends('base')

<title>Type</title>

@section('content')
    <h4>Type / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un type</h4>
                <form class="form-sample" action="{{ route('types.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Type</label>
                    <input type="text" name="type" class="form-control"><br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
