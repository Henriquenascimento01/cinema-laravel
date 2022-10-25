@extends('layouts.main')


@section('title', 'Cinema')


@section('content')



    <div id="movie-create-container" class="col-md-4 offset-md-3">
        <h1>Editar gênero</h1>
        @if (session('msg-error'))
            <div class="alert alert-danger">
                {{ session('msg-error') }}
            </div>
        @endif
        <form action="{{ route('tags-update', ['id' => $tags->id]) }}" method="POST">
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
                <label for="text">Sala de transmissão:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $tags->name }}">
            </div>

            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>
@endsection
