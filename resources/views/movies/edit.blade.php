@extends('layouts.main')


@section('title', 'Cadastrar filme')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastre o filme</h1>
        <form action="{{ route('movies-update', ['id' => $movies->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <input type="text" class="form-control" id="name" name="name" placeholder="Titulo do filme"
                    value="{{ $movies->name }}">
            </div>

            <div class="form-group">
                <label for="image">Banner:</label>
                <input type="file" class="form-control-file" id="image" name="image" value="{{ $movies->image}}">
            </div>

            <div class="form-group">
                <label for="time">Tempo de duração</label>
                <input type="time" class="form-control" id="duration" name="duration" placeholder="Tempo de duração"
                    value="{{ $movies->duration }}">
            </div>

            <div class="form-group">
                <label for="tag">Gênero:</label>
                <input class="form-control" type="text" name="tag" placeholder="Gênero" value="#">
            </div>

            <div class="form-group">
                <label for="tag">Classificação indicativa:</label>
                <input class="form-control" type="text" name="classification" placeholder="Classificação indicativa"
                    value="#">
            </div>

            <div class="form-group mt-5">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control"
                    value="{{ $movies->description }}"></textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>
@endsection
