@extends('layouts.main')


@section('title', 'Cinema')

@section('content')


    <div id="search-container" class="col md-12">
        <h1>Busque por um filme</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar filme">
        </form>
    </div>
    <div id="movie-container" class="col md-12">
        <h2>Proximas Sessões</h2>
        <p class="subtitle">Veja as sessões dos proximos dias</p>

        <div id="cards-container" class="row">
            @foreach ($sessions as $session)
                <div class="col md-4">

                    <img src="/img/movies/{{ $session->image }}">

                    <div class="card-body">
                        <p class="card-date">{{ $session->date }}</p>
                        <h5 class="card-title">{{ $session->movie->name }}</h5>
                        <p class="card-duration">Inicio: {{ $session->time_initial }}</p>
                        <p class="card-duration">Término: {{ $session->time_finish }}</p>
                        <a href="" class="btn btn-info">Mais informações</a>
                        <a href="{{ route('sessions-edit', ['id' => $session->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('sessions-destroy', ['id' => $session->id]) }}" method="POST"
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
