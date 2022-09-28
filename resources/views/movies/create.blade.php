@extends('layouts.main')


@section('title', 'Cadastrar filme')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastre o filme</h1>
        <form action="{{ route('movies-store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Titulo:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Titulo do filme">
            </div>
            <div>
                <label for="tag">Gênero:</label>
                <select name="tag" id="tag" class="form-control">
                    <option selected="disabled" value="Selecione"></option>
                    <option value="acao">Ação</option>
                    <option value="comedia">Comédia</option>
                    <option value="comedia">Desenho</option>
                    <option value="drama">Drama</option>
                    <option value="romance">Romance</option>
                    <option value="documentario">Documentário</option>
                    <option value="suspense">Suspense</option>
                    <option value="terror">Terror</option>
                    <option value="ficcao">Ficção científica</option>
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
