@extends('layouts.main')


@section('title', 'Cinema')

@section('content')


    <div id="search-container" class="col md-12">
        <h1>Busque por um filme</h1>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Buscar filme">
        </form>
    </div>
    <div id="movie-container" class="col md-12">
        <h2>Proximos fimes</h2>
        <p class="subtitle">Veja os filmes dos proximos dias</p>

        <div id="cards-container" class="row">
            @foreach ($movies as $movie)
                <div class="col md-4">
                    <img src="/img/Logozoeira.png" alt="">
                    <div class="card-body">
                        <p class="card-id">{{ $movie->id }}</p>
                        <p class="card-date">{{ $movie->date }}</p>
                        <h5 class="card-title">{{ $movie->name }}</h5>
                        <p class="card-duration">{{ $movie->time }}</p>
                        <a href="" class="btn btn-info">Mais informações</a>
                        <a href="{{ route('movies-edit', ['id' => $movie->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('movies-destroy', ['id' => $movie->id]) }}" method="POST" class="form-group">
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
