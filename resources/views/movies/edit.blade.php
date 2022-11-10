@extends('layouts.main')


@section('title', 'Editar filme')

@section('content')


    <div id="movie-create-container" class="col-md-6 offset-md-3">
        <h1>Editar o filme</h1>
        <form action="{{ route('movies-update', ['id' => $movies->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if (session('msg-error'))
                <div class="alert alert-danger">
                    {{ session('msg-error') }}
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
                <input type="file" class="form-control-file" id="image" name="image">
                <img src="/img/movies/{{$movies->image }}" alt="" class="img-preview">
            </div>


            <div class="form-group">
                <label for="tag_id">Gênero:</label>
                <select name="tag_id" id="tag_id" class="form-control">
                    <option value="tag_id">Selecione</option>
                    @foreach ($tags as $tag)
                        <option @if ($movies->tag_id == $tag->id) selected @endif name="tag_id"
                            value="{{ $tag->id }}"> {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="classification_id">Classificação indicativa:</label>
                <select name="classification_id" id="classification_id" class="form-control">
                    <option value="classification_id">Selecione</option>
                    @foreach ($classifications as $classification)
                        <option @if ($movies->classification_id == $classification->id) selected @endif name="classification_id"
                            value="{{ $classification->id }}"> {{ $classification->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-5">
                <label for="number">Descrição:</label>
                <textarea name="description" id="description" cols="10" rows="5" class="form-control" value="description">{{ $movies->description }}</textarea>
            </div>
            <input type="submit" class="btn btn-success" value="Editar">
        </form>
    </div>
@endsection
