@extends('base')

<title>Devises</title>

@section('content')
    <h4>Devises / Edit</h4>

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier un devises</h4>
                <form action="{{ route('devices.update', $device->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ $device->name }}" required
                        placeholder="Ex: Ariary" /><br><br>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection

