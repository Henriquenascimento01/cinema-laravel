@extends('layouts.main')


@section('title', 'Classificações indicativas')


@section('content')

    <main>
        <div class="container-fluid">
            <div class="mt-5">

                @yield('content')
                <a href="{{ route('classifications-create') }}" class="btn btn-success mt-5">Criar classificação</a>
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
            @foreach ($classifications as $classification)
                <tr class="rooms-index-list">
                    <th scope="row">{{ $classification->name }}</th>
                    <td>
                        <a href="{{ route('classifications-edit', ['id' => $classification->id]) }}"
                            class="btn btn-warning">Editar</a>
                        <form action="{{ route('classifications-destroy', ['id' => $classification->id]) }}" method="POST"
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
