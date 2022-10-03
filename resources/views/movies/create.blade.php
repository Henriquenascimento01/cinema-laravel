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
                <input type="text" class="form-control" id="name" name="name" placeholder="Titulo do filme">
            </div>

            <div>
                <label for="tag">Gênero:</label>
                <select name="tag" id="tag" class="form-control">
                    <option selected="disabled" value="Selecione"></option>
                    <option value="Acao">Ação</option>
                    <option value="Comedia">Comédia</option>
                    <option value="Desenho">Desenho</option>
                    <option value="Drama">Drama</option>
                    <option value="Romance">Romance</option>
                    <option value="Documentario">Documentário</option>
                    <option value="Suspense">Suspense</option>
                    <option value="Terror">Terror</option>
                    <option value="Ficcao">Ficção científica</option>
                </select>
            </div>

            <div class="form-group mt-5">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control"></textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>

@endsection
