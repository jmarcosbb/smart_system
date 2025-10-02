<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Horário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-horario { width: 100%; height: 80px; font-size: 1.8rem; margin-bottom: 15px; }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center w-75">
            <h1 class="display-5 mb-5">Por favor, selecione o horário:</h1>
            
                <div class="row">
                @foreach($horarios as $horario)
                    <div class="col-md-4">
                        @if($fluxo == 'embarcar')
                            {{-- Botão para o fluxo de EMBARQUE --}}
                            <a href="{{ route('terminal.embarcar.opcoes', ['horario' => $horario]) }}" class="btn btn-primary btn-horario d-flex align-items-center justify-content-center">
                                {{ $horario }}
                            </a>
                        @else
                            {{-- Botão para o fluxo de DEIXAR PASSAGEIRO (agora com as classes corretas) --}}
                            <a href="{{ route('terminal.saida.deixar-passageiro', ['horario' => $horario]) }}" class="btn btn-info btn-horario d-flex align-items-center justify-content-center">
                                {{ $horario }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            <a href="{{ route('terminal.index') }}" class="btn btn-link mt-4">Voltar</a>
        </div>
    </div>
</body>
</html>