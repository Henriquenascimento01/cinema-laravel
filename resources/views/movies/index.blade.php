@extends('layouts.main')


@section('title', 'Salas disponiveis')


@section('content')


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Genero</th>
                <th scope="col">Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <th scope="row">{{ $movie->id }}</th>
                    <td>{{ $movie->name }}</td>
                    <td>Teste</td>
                    <td>{{ $movie->description }}</td>
                    <td>
                        <a href="{{ route('movies-edit', ['id' => $movie->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('movies-destroy', ['id' => $movie->id]) }}" method="POST"
                            class="form-group">
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
