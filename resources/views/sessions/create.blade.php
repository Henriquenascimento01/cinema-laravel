@extends('layouts.main')


@section('title', 'Cadastrar sessão')


@section('content')

    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastrar sessão</h1>

        @if (session('msg-error'))
            <div class="alert alert-danger" role="alert">
                <p class="msg">{{ session('msg-error') }}</p>
            </div>
        @endif


        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('sessions-store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Data de transmissão"
                    value="{{ old('date') }}">
            </div>
            <div class="form-group">
                <label for="time">Horário inicio:</label>
                <input type="time" class="form-control" id="time_initial" name="time_initial"
                    placeholder="Horário de transmissão" value="{{ old('time_initial') }}">
            </div>
            <div class="form-group">
                <label for="time">Horário termino:</label>
                <input type="time" class="form-control" id="time_finish" name="time_finish"
                    placeholder="Horário de transmissão" value="{{ old('time_finish') }}">
            </div>

            <div class="form-group">
                <label for="room_id">ID sala:</label>
                <select name="room_id" id="room_id" class="form-control">
                    <option selected="disabled" name="room_id" value="{{ old('room_id') }}">Selecione</option>
                    @foreach ($rooms as $room)
                        <option name="room_number" @if (old('room_id') == $room->id) {{ 'selected="selected"' }} @endif
                            value="{{ $room->id }}"> {{ $room->number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Filme:</label>

                <select name="movie_id" id="movie_id" class="form-control">
                    <option selected="disabled" name="movie_id" value="{{ old('movie_id') }}">Selecione</option>
                    @foreach ($movies as $movie)
                        <option name="movie_id" @if (old('movie_id') == $movie->id) {{ 'selected="selected"' }} @endif
                            value="{{ $movie->id }}">{{ $movie->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success mt-3" value="Criar sessão">
        </form>
    </div>
@endsection
