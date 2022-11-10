@extends('layouts.main')


@section('title', 'Cadastrar sala')


@section('content')

    <div id="movie-create-container" class="col-md-4 offset-md-3">
        <h1>Criar classificação indicativa</h1>

        @if (session('msg-error'))
            <div class="alert alert-danger">
                {{ session('msg-error') }}
            </div>
        @endif
        <form action=" {{ route('classifications-store') }}" method="POST" class="mt-5">
            @csrf
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
                <label for="text">Classificação indicativa:</label>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="Classificação indicativa" value="{{ old('name') }}">
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar">
        </form>
    </div>
@endsection
