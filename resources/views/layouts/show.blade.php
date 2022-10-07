@extends('layouts.main')


@section('title', 'Cinema')

@section('content')


    <div id="search-container" class="col md-12">
        <h1>Busque por um filme</h1>
        <form action="{{ route('search') }}" method="get">
            @csrf
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar filme">
        </form>
    </div>
    <div id="movie-container" class="col md-12">
        <h2>Filmes encontrados</h2>

        <div id="cards-container" class="row">

            @foreach ($movies as $movie)
                <div class="col md-4">

                    <img src="/img/movies/{{ $movie->image }}">

                    <div class="card-body">
                        <p class="card-date">{{ \Carbon\Carbon::parse($movie->date)->format('d/m/Y') }}</p>
                        <h5 class="card-title">{{ $movie->name }}</h5>
                        <p class="card-duration">Inicio: {{ \Carbon\Carbon::parse($movie->time_initial)->format('H:i') }}
                        </p>
                        <p class="card-duration">Término: {{ \Carbon\Carbon::parse($movie->time_finish)->format('H:i') }}
                        </p>
                        <a href="{{ route('sessions-show', ['id' => $movie->id]) }}" class="btn btn-info">Mais
                            informações</a>
                        <a href="{{ route('sessions-edit', ['id' => $movie->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('sessions-destroy', ['id' => $movie->id]) }}" method="POST"
                            class="form-group">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Apagar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
