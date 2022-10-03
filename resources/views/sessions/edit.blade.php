@extends('layouts.main')


@section('title', 'Edit')


@section('content')

    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Editar sessão</h1>
        <form action="{{ route('sessions-update', ['id' => $sessions->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <ul class="error">
                    @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="form-group">
                <label for="image">Banner:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <img src="/img/movies{{ $sessions->image }}" class="image-preview">
            </div>

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $sessions->date }}">
            </div>
            <div class="form-group">
                <label for="time">Horário inicio:</label>
                <input type="time" class="form-control" id="time_initial" name="time_initial"
                    value="{{ $sessions->time_initial }}">
            </div>
            <div class="form-group">
                <label for="time">Horário termino:</label>
                <input type="time" class="form-control" id="time_finish" name="time_finish"
                    value="{{ $sessions->time_finish }}">
            </div>

            <div class="form-group">
                <label for="room_id">ID sala:</label>
                <select name="room_id" id="room_id" class="form-control">
                    <option value="room_id">Selecione</option>
                    @foreach ($rooms as $room)
                        <option @if ($sessions->room_id == $room->id) selected @endif name="room_id"
                            value="{{ $room->id }}">{{ $room->number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Filme:</label>
                <select name="movie_id" id="movie_id" class="form-control">
                    <option value="movie_id">Selecione</option>
                    @foreach ($movies as $movie)
                        <option @if ($sessions->movie_id == $movie->id) selected @endif name="movie_id"
                            value="{{ $movie->id }}">{{ $movie->name }}</option>
                    @endforeach
                </select>

            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection
