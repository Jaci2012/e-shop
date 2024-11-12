@extends('base')

<title>Type</title>

@section('content')
    <h4>Type / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Type</h4>
                <form action="{{ route('types.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label">Type</label>
                    <input type="text" name="type" class="form-control" value="{{ $type->type }}" required><br><br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection

