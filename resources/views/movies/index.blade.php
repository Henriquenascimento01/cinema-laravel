@extends('layouts.main')


@section('title', 'Filmes')


@section('content')


    <table class="table">
        <thead>
            <tr class="movies-index-title">
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Gênero</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($movies as $movie)
                <tr class="movies-index-list">
                    <th scope="row">{{ $movie->id }}</th>
                    <th scope="row">{{ $movie->name }}</th>
                    <th scope="row">{{ $movie->description }}</th>
                    <th scope="row">{{ $movie->tag }}</th>
                    
                    <td>
                        <a href="{{ route('movies-edit', ['id' => $movie->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('movies-destroy', ['id' => $movie->id]) }}" method="POST" class="form-group">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
