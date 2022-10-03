@extends('layouts.main')


@section('title', 'Mais informações')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/movies/{{ $sessions->image }}" class="img-fluid">
                <div id="info-container" class="col-md-6">
                    <a href="{{ route('index') }}"" class="btn btn-primary">Página anterior</a>
                    <h1>{{ $sessions->movie->name }}</h1>
                    <p class="session-date">Data: {{ $sessions->date }}</p>
                    <p class="session-init">Inicio: {{ $sessions->time_initial }}</p>
                    <p class="sessions-finish">Termino: {{ $sessions->time_finish }}</p>
                    <p class="session-room">Sala: {{ $sessions->room->number }}</p>
                    <p class="session-tag">Gênero: {{ $sessions->movie->tag }}</p>
                </div>
                <div class="col-md-12 mt-5" id="description-container">
                    <h3>Descrição</h3>
                    <p class="session-description">{{ $sessions->movie->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
