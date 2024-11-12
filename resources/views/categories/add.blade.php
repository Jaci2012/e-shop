@extends('base')

<title>Catégorie</title>

@section('content')
    <h4>Catégorie / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un catégorie</h4>
                <form class="form-sample" action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Designation</label>
                    <input type="text" name="designation" class="form-control"
                        placeholder="Ex: Materiel Informatique" /><br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
