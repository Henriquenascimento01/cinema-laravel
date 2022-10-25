@extends('layouts.main')


@section('title', 'Filmes')


@section('content')

    <div id="movie-container" class="col md-12">
        <h2>Filmes cadastrados</h2>
        @if (session('msg-error'))
            <div class="alert alert-danger">
                {{ session('msg-error') }}
            </div>
        @endif
        <a href="{{ route('sessions-create') }}" class="btn btn-success mt-5">Criar sessão</a>
        <a href="{{ route('movies-create') }}" class="btn btn-warning mt-5">Criar filme</a>
        <div id="cards-container" class="row mt-5">

            @foreach ($movies as $movie)
                <div class="col md-4">

                    <img src="/img/movies/{{ $movie->image }}">

                    <div class="card-body">
                        <h5 class="card-title">Titulo: {{ $movie->name }}</h5>
                        <p class="card-duration">Classificação: {{ $movie->classification->name }}</p>
                        <p class="card-duration">Gênero: {{ $movie->tag->name }}</p>
                        <a href="{{ route('movies-edit', ['id' => $movie->id]) }}" class="btn btn-warning">Editar</a>

                        <form action="{{ route('movies-destroy', ['id' => $movie->id]) }}" method="POST"
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
