@extends('base')

<title>Vendeurs</title>

@section('content')
    <h4>Vendeurs / Add</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un vendeur</h4>
                <form class="form-sample" action="{{ route('vendeurs.store') }}" method="POST">
                    @csrf
                    <label class="col-sm-3 col-form-label">Role</label>
                    <select name="roles_id" class="form-control" required>
                        <option value="">--Selectionnez--</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                    <label class="col-sm-3 col-form-label">Nom de vendeurs</label>
                    <input type="text" name="name" class="form-control" placeholder="" />
                    <label class="col-sm-3 col-form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" placeholder="" />
                    <label class="col-sm-3 col-form-label">Numero</label>
                    <input type="text" name="numero" class="form-control" placeholder="" />
                    <label class="col-sm-3 col-form-label">E-mail</label>
                    <input type="text" name="email" class="form-control" placeholder="" />
                    <br><br>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
