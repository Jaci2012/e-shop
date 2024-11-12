@extends('base')

<title>Roles</title>

@section('content')
    <h4>Roles / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un role</h4>
                <form class="form-sample" action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <label class="col-sm-3 col-form-label">Role</label>
                    <input type="text" name="role" class="form-control" placeholder="" />
                    <br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
