@extends('layouts.main')


@section('title', 'Cinema')


@section('content')

    <div id="movie-create-container" class="col-md-4 offset-md-3">
        <h1>Editar sala</h1>
        <form action="{{ route('rooms-store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="number">Sala de transmissão:</label>
                <input type="number" class="form-control" id="number" name="number" value="{{ $rooms->number }}">
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>

@endsection