@extends('layouts.main')


@section('title', 'Mais informações')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/movies/{{ $sessions->image }}" alt="" class="img-fluid">
                <div id="info-container" class="col-md-6">
                    <a href="{{ route('index') }}"" class="btn btn-primary">Página anterior</a>
                    <h1>{{ $sessions->movie->name }}</h1>
                    <p class="session-date">{{ \Carbon\Carbon::parse($sessions['date'])->format('d/m/Y') }}</p>
                    <p class="session-init">Inicio: {{ \Carbon\Carbon::parse($sessions['time_initial'])->format('H:i') }}
                    </p>
                    <p class="sessions-finish">Termino: {{ \Carbon\Carbon::parse($sessions['time_finish'])->format('H:i') }}
                    </p>
                    <p class="session-room">Sala: {{ $sessions->room->number }}</p>
                    <p class="session-tag">Gênero: {{ $sessions->movie->tag }}</p>
                </div>
                <div class="col-md-12" id="description-container">
                    <h3>Descrição</h3>
                    <p class="session-description">{{ $sessions->movie->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
