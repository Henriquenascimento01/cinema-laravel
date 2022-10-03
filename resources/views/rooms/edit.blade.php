@extends('layouts.main')


@section('title', 'Cinema')


@section('content')



    <div id="movie-create-container" class="col-md-4 offset-md-3">
        <h1>Editar sala</h1>
        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <form action="{{ route('rooms-update', ['id' => $rooms->id]) }}" method="POST">
            @csrf
            @method('PUT')
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
                <label for="number">Sala de transmissão:</label>
                <input type="number" class="form-control" id="number" name="number" value="{{ $rooms->number }}">
            </div>

            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>

@endsection
