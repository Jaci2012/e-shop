@extends('base')

<title>Catégorie</title>

@section('content')
    <h4>Catégorie / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un catégorie</h4>
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label">Designation</label>
                    <input type="text" name="designation" class="form-control" value="{{ $category->designation }}" required
                        placeholder="Ex: Materiel Informatique" /><br><br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection

