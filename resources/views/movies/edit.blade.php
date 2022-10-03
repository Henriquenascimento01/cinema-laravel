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
            <div>
                <label for="tag">Gênero:</label>
                <select name="tag" id="tag" class="form-control" value="{{ $movies->tag }}">
                    <option selected="disabled" value="Selecione"></option>
                    <option value="acao">Ação</option>
                    <option value="comedia">Comédia</option>
                    <option value="drama">Drama</option>
                    <option value="romance">Romance</option>
                    <option value="documentario">Documentário</option>
                    <option value="suspense">Suspense</option>
                    <option value="terror">Terror</option>
                    <option value="ficcao">Ficção científica</option>
                </select>
            </div>

            <div class="form-group">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control">{{ $movies->description }}</textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>

@endsection
