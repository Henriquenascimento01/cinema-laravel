@extends('layouts.main')


@section('title', 'Cadastrar filme')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Cadastre o filme</h1>
        <form action="{{ route('movies-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="image">Banner:</label>
                <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
            </div>

            <div class="form-group">
                <label for="time">Tempo de duração</label>
                <input type="time" class="form-control" id="duration" name="duration"
                    placeholder="Tempo de duração" value="{{ old('duration') }}">
            </div>

            <div class="form-group">
                <label for="tag_id">Gênero:</label>
                <select name="tag_id" id="tag_id" class="form-control">
                    <option selected="disabled" name="tag_id" value="{{ old('tag_id') }}">Selecione</option>
                    @foreach ($tags as $tag)
                        <option name="tag_id" value="{{ $tag->id }}"> {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="classification_id">Classificação indicativa:</label>
                <select name="classification_id" id="classification_id" class="form-control">
                    <option selected="disabled" name="classification_id" value="{{ old('classification_id') }}">Selecione</option>
                    @foreach ($classifications as $classification)
                        <option name="classification_id" value="{{ $classification->id }}"> {{ $classification->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-5">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control"
                    value="{{ old('description') }}"></textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection
