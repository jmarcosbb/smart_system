<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantidade de Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control-lg {
            height: 100px;
            font-size: 3rem;
            text-align: center;
        }
        .btn-confirm {
            width: 100%;
            height: 100px;
            font-size: 2rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center w-75">

            <h1 class="display-5 mb-4">Categoria: <span class="text-primary">{{ $tipoDisplay }}</span></h1>
            <h2 class="mb-5">Informe a quantidade de pessoas no veículo (incluindo você):</h2>
            
            <form action="{{ route('terminal.embarcar.registrar') }}" method="POST">
                @csrf
                
                <input type="hidden" name="horario" value="{{ $horario }}">
                <input type="hidden" name="tipo" value="{{ $tipo }}">
                
                <div class="mb-4">
                    <input 
                        type="number" 
                        name="quantidade" 
                        class="form-control form-control-lg"
                        value="1"
                        min="1"
                        required>
                </div>
                
                <button type="submit" class="btn btn-success btn-confirm">Confirmar Embarque</button>
            </form>

            {{-- LINHA CORRIGIDA --}}
            <a href="{{ route('terminal.embarcar.opcoes', ['horario' => $horario]) }}" class="btn btn-link mt-4">Voltar</a>
        </div>
    </div>
</body>
</html>