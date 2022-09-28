@extends('layouts.main')


@section('title', 'Cinema')


@section('content')


    @foreach ($room as $room)
        <div id="movie-create-container" class="col-md-4 offset-md-3">
            <h1>Editar sala</h1>
            <form action="{{ route('rooms-update', ['id' => $room->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="number">Sala de transmissão:</label>
                    <input type="number" class="form-control" id="number" name="number" value="{{ $room->number }}">
                </div>
    @endforeach
    <input type="submit" class="btn btn-success" value="Editar">
    </form>
    </div>

@endsection
