<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cretive movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-auto">
                <div class="container ">
                    <div class="form-group">
                        <img src="/img/Logozoeira.png" width="500px" alt="Logo">
                    </div>
                    @if(session('danger'))
                    <div class="alert alert-danger">
                        {{session('danger')}}
                    </div>
                    @endif
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="form-group">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-md-9 offset-md-3">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control " placeholder="Digite seu e-mail">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 offset-md-3">
                                <label>Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="Digite sua senha">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" value="Login" class="btn btn-primary">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>