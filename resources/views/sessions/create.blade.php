@extends('layouts.main')


@section('title', 'Cadastrar sessão')


@section('content')

    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastrar sessão</h1>
        

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('sessions-store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Banner:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Data de transmissão">
            </div>
            <div class="form-group">
                <label for="time">Horário inicio:</label>
                <input type="time" class="form-control" id="time_initial" name="time_initial"
                    placeholder="Horário de transmissão">
            </div>
            <div class="form-group">
                <label for="time">Horário termino:</label>
                <input type="time" class="form-control" id="time_finish" name="time_finish"
                    placeholder="Horário de transmissão">
            </div>

            <div class="form-group">
                <label for="room_id">ID sala:</label>
                <select name="room_id" id="room_id" class="form-control">
                    <option selected="disabled" name="room_id" value="room_id">Selecione</option>
                    @foreach ($rooms as $room)
                        <option name="room_number" value="{{ $room->id }}"> {{ $room->number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Filme:</label>

                <select name="movie_id" id="movie_id" class="form-control">
                    <option selected="disabled" name="movie_id" value="movie_id">Selecione</option>
                    @foreach ($movies as $movie)
                        <option name="movie_id" value="{{ $movie->id }}">{{ $movie->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection
