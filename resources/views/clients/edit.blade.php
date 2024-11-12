@extends('base')

<title>Clients</title>

@section('content')
    <h4>Clients / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un Client</h4>
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label">Roles</label>
                        <select name="roles_id" class="form-control" required>
                            <option value="">--Selectionnez--</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $client->roles_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->role }}
                                </option>
                            @endforeach
                        </select>

                    <label class="col-sm-3 col-form-label">Nom Client</label>
                    <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>

                    <label class="col-sm-3 col-form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="{{ $client->adresse }}" required>

                    <label class="col-sm-3 col-form-label">Numero</label>
                    <input type="tel" name="numero" class="form-control" value="{{ $client->numero }}" required>

                    <label class="col-sm-3 col-form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
                    <br><br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
