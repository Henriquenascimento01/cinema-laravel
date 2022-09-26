@extends('layouts.main')


@section('title', 'Cinema')

@section('content')


<div id="search-container" class="col md-12">
    <h1>Busque por um filme</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Buscar filme">
    </form>
</div>
<div id="movie-container" class="col md-12">
    <h2>Proximos fimes</h2>
    <p class="subtitle">Veja os filmes dos proximos dias</p>
    <div id="cards-container" class="row">
        <!--Aqui irá o foreach -->
        <div class="card col md-3">
            <img src="/img/Logozoeira.png" alt="">
            <div class="card-body">
                <p class="card-date">xx/xx/xxxx</p>
                <h5 class="card-title"> Nome do filme</h5>
                <p class="card-duration">Tempo de duração</p>
                <a href="" class="btn btn-primary">Mais informações</a>
            </div>
        </div>
        <!-- Aqui finaliza o foreach -->
    </div>
</div>

@endsection