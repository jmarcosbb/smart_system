<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Redireciona para a tela inicial após 10 segundos --}}
    <meta http-equiv="refresh" content="10;url={{ route('terminal.index') }}">
    <style>
        .barcode {
            font-family: 'Libre Barcode 39', cursive;
            font-size: 4rem;
            border: 2px solid #333;
            padding: 20px;
            letter-spacing: 5px;
        }
    </style>
    {{-- Fonte especial para simular o código de barras --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-4 text-success">Ticket Gerado!</h1>
            <p class="lead">Apresente o código abaixo na saída.</p>
            
            <div class="barcode my-4">
                {{ $barcode }}
            </div>
            
            <p class="text-muted">Esta tela irá fechar automaticamente em 10 segundos.</p>
        </div>
    </div>
</body>
</html>