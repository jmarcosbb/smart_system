<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal de Embarque</title>
    {{-- Para um visual melhor em tablets, recomendo usar um framework CSS como Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para parecer mais com um totem/tablet */
        .btn-option {
            width: 100%;
            height: 150px;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center w-75">
            <h1 class="display-4 mb-5">Por favor, selecione uma opção:</h1>
            
            {{-- Opção 1 --}}
            <a href="{{ route('terminal.horario', ['fluxo' => 'embarcar']) }}" class="btn btn-primary ...">
                Irei embarcar neste veículo
            </a>
            
            {{-- Opção 2 --}}
            <a href="{{ route('terminal.saida.quantidade.sem-horario', ['tipo' => 'nao-embarcar']) }}" class="btn btn-secondary ...">
                Não irei embarcar
            </a>

            {{-- Opção 3 --}}
            <a href="{{ route('terminal.horario', ['fluxo' => 'deixar-passageiro']) }}" class="btn btn-info ...">
                Irei deixar passageiro(s) no terminal e não irei embarcar
            </a>
        </div>
    </div>
</body>
</html>