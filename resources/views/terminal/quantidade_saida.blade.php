<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informar Quantidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control-lg { height: 100px; font-size: 3rem; text-align: center; }
        .btn-confirm { width: 100%; height: 100px; font-size: 2rem; }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center w-75">
            <h1 class="display-5 mb-4">Opção: <span class="text-primary">{{ $titulo }}</span></h1>
            <h2 class="mb-5">{{ $pergunta }}</h2>
            
            <form action="{{ route('terminal.saida.registrar') }}" method="POST">
                @csrf
                <input type="hidden" name="tipo" value="{{ $tipo }}">
                
                {{-- ================= CORREÇÃO PRINCIPAL AQUI ================= --}}
                {{-- Garante que o horário seja enviado junto com o formulário, se ele existir --}}
                @if($horario)
                    <input type="hidden" name="horario" value="{{ $horario }}">
                @endif
                {{-- ================= FIM DA CORREÇÃO ================= --}}
                
                <div class="mb-4">
                    <input type="number" name="quantidade" class="form-control form-control-lg" value="1" min="1" required>
                </div>
                
                <button type="submit" class="btn btn-success btn-confirm">Gerar Ticket</button>
            </form>

            {{-- O botão "Cancelar" agora volta para a tela de horários se houver um horário --}}
            @if($horario)
                <a href="{{ route('terminal.horario', ['fluxo' => 'deixar-passageiro']) }}" class="btn btn-link mt-4">Cancelar e Voltar</a>
            @else
                <a href="{{ route('terminal.index') }}" class="btn btn-link mt-4">Cancelar e Voltar</a>
            @endif
        </div>
    </div>
</body>
</html>