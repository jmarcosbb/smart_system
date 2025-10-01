<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opções de Embarque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-option {
            width: 100%;
            height: 100px;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center w-75">
        <h1 class="display-5 mb-4">Selecione sua categoria de embarque:</h1>
                    
<div class="row">
    {{-- Para cada botão, passamos um array com os dois parâmetros que a rota precisa: 'horario' e 'tipo' --}}
    
    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'com-passagem']) }}" class="btn btn-success btn-option d-flex align-items-center justify-content-center">
            Com passagem
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'sem-passagem']) }}" class="btn btn-warning btn-option d-flex align-items-center justify-content-center">
            Sem passagem
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'prioridade-por-lei']) }}" class="btn btn-danger btn-option d-flex align-items-center justify-content-center">
            Prioridade por Lei
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'motocicletas']) }}" class="btn btn-dark btn-option d-flex align-items-center justify-content-center">
            Motocicletas
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'veiculos-pesados']) }}" class="btn btn-secondary btn-option d-flex align-items-center justify-content-center">
            Veículos Pesados
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'vans-micro-onibus']) }}" class="btn btn-info btn-option d-flex align-items-center justify-content-center">
            Vans/Micro-ônibus
        </a>
    </div>
</div>
        <a href="{{ route('terminal.embarcar.quantidade', ['horario' => $horario, 'tipo' => 'com-passagem']) }}" ...></a>
        <a href="{{ route('terminal.index') }}" class="btn btn-link mt-4">Voltar</a>
        </div>
    </div>
</body>
</html>