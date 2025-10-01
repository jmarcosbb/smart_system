<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Redireciona para a página inicial após 5 segundos --}}
    <meta http-equiv="refresh" content="5;url={{ route('terminal.index') }}">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-4 text-success">Registrado!</h1>
            <p class="lead">{!! $mensagem !!}</p>
            <p>Você será redirecionado para a tela inicial em breve...</p>
        </div>
    </div>
</body>
</html>