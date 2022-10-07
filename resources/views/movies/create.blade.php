@extends('layouts.main')


@section('title', 'Cadastrar filme')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastre o filme</h1>
        <form action="{{ route('movies-store') }}" method="POST">
            @csrf
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
                    value="{{ old('name') }}">
            </div>


            <div class="form-group">
                <label for="tag">Gênero:</label>
                <input class="form-control" type="text" name="tag" placeholder="Gênero" value="{{ old('tag') }}">
            </div>

            <div class="form-group">
                <label for="tag">Classificação indicativa:</label>
                <input class="form-control" type="text" name="classification" placeholder="Classificação indicativa"
                    value="{{ old('classification') }}">
            </div>

            <div class="form-group mt-5">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control"
                    value="{{ old('description') }}"></textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection
