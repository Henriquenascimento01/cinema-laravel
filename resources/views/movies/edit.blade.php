@extends('layouts.main')


@section('title', 'Editar')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Editar filme</h1>
        <form action="{{ route('movies-update', ['id' => $movies->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
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
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Titulo do filme"
                    value="{{ $movies->name }}">
            </div>

            <div class="form-group">
                <label for="tag">Gênero:</label>
                <input class="form-control" type="text" name="tag" placeholder="Gênero" value="{{ $movies->tag }}">
            </div>

            <div class="form-group">
                <label for="tag">Classificação indicativa:</label>
                <input class="form-control" type="text" name="classification" placeholder="Classificação indicativa"
                    value="{{ $movies->classification }}">
            </div>

            <div class="form-group">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control">{{ $movies->description }}</textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>

@endsection
