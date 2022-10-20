@extends('layouts.main')


@section('title', 'Gêneros')


@section('content')

    <main>
        <div class="container-fluid">
            <div class="mt-5">

                @yield('content')
                <a href="{{ route('tags-create') }}" class="btn btn-success mt-5">Criar gêneros</a>
            </div>
        </div>
    </main>
    <table class="table mt-5">

        <thead>
            <tr class="rooms-index-title">
                <th scope="col">Titulo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr class="rooms-index-list">
                    <th scope="row">{{ $tag->name }}</th>
                    <td>
                        <a href="{{ route('tags-edit', ['id' => $tag->id]) }}"
                            class="btn btn-warning">Editar</a>
                        <form action="{{ route('tags-destroy', ['id' => $tag->id]) }}" method="POST"
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
