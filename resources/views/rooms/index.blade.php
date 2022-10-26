@extends('layouts.main')


@section('title', 'Salas')


@section('content')

    <main>
        <div class="container-fluid">
            <div class="mt-5">

                @yield('content')
                <a href="{{ route('rooms-create') }}" class="btn btn-success">Criar sala</a>
            </div>
        </div>
    </main>
    @if (session('msg-error'))
        <div class="alert alert-danger">
            {{ session('msg-error') }}
        </div>
    @endif
    
    <table class="table mt-5">
        <thead>
            <tr class="rooms-index-title">
                <th scope="col">Número</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr class="rooms-index-list">
                    <th scope="row">{{ $room->number }}</th>
                    <td>
                        <a href="{{ route('rooms-edit', ['id' => $room->id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('rooms-destroy', ['id' => $room->id]) }}" method="POST" class="form-group">
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
