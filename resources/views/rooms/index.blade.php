@extends('layouts.main')


@section('title', 'Salas')


@section('content')


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Número</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
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
