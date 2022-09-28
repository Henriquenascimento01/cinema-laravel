@extends('layouts.main')


@section('title', 'Salas disponiveis')


@section('content')

    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Editar sessão</h1>
        <form action="{{ route('sessions-update', ['id' => $sessions->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $sessions->date }}">
            </div>
            <div class="form-group">
                <label for="time">Horário:</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ $sessions->time }}">
            </div>

            <div class="form-group">
                <label for="room_id">ID sala:</label>
                <select name="room_id" id="room_id" class="form-control">
                    <option value="room_id">Selecione</option>
                    @foreach ($rooms as $room)
                        <option @if ($sessions->room_id == $room->id) selected @endif name="room_id"
                            value="{{ $sessions->room_id }}">{{ $sessions->room->number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Filme:</label>
                <select name="movie_id" id="movie_id" class="form-control">
                    <option value="movie_id">Selecione</option>
                    @foreach ($movies as $movie)
                        <option @if ($sessions->movie_id == $movie->id) selected @endif name="movie_id"
                            value="{{ $sessions->movie_id }}">{{ $sessions->movie->name }}</option>
                    @endforeach
                </select>

            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection