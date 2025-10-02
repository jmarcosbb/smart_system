<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Controle - Smart System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-sortable th a { color: inherit; text-decoration: none; display: block; }
        .table-sortable th a:hover { color: #FFF; }
        .ticket-font { font-size: 1.1em; color: #333; font-family: monospace; font-weight: bold; }
        .filter-btn .badge { margin-left: 8px; }
        .table tfoot th { text-align: right; font-size: 1.1em; }
    </style>
</head>
<body>
    <div class="container-fluid my-4 px-4">
        <h1 class="mb-4">Painel de Monitoramento</h1>

        <div class="card mb-4">
            <div class="card-header"><h4>Filtrar Registros</h4></div>
            <div class="card-body">
                <h5>Por Tipo de Fluxo</h5>
                <a href="{{ route('painel.index', ['fluxo' => 'embarque']) }}" class="btn btn-primary mb-2 filter-btn">
                    Embarques <span class="badge bg-light text-dark">{{ $totais['fluxo']['embarque'] ?? 0 }}</span>
                </a>
                <a href="{{ route('painel.index', ['fluxo' => 'deixar-passageiro']) }}" class="btn btn-info mb-2 filter-btn">
                    Deixando Passageiros <span class="badge bg-light text-dark">{{ $totais['fluxo']['deixar-passageiro'] ?? 0 }}</span>
                </a>
                <a href="{{ route('painel.index', ['fluxo' => 'nao-embarcar']) }}" class="btn btn-secondary mb-2 filter-btn">
                    Não Embarcaram <span class="badge bg-light text-dark">{{ $totais['fluxo']['nao-embarcar'] ?? 0 }}</span>
                </a>
                <hr>

                <h5>Por Categoria de Embarque</h5>
                @foreach($categoriasDisponiveis as $categoria)
                    @php
                        $btnColor = 'btn-dark';
                        switch ($categoria) {
                            case 'com-passagem': $btnColor = 'btn-success'; break;
                            case 'sem-passagem': $btnColor = 'btn-warning text-dark'; break;
                            case 'prioridade-por-lei': $btnColor = 'btn-danger'; break;
                        }
                    @endphp
                    <a href="{{ route('painel.index', ['categoria' => $categoria]) }}" class="btn {{ $btnColor }} mb-2 filter-btn">
                        {{ ucwords(str_replace('-', ' ', $categoria)) }} 
                        <span class="badge bg-light text-dark">{{ $totais['categoria'][$categoria] ?? 0 }}</span>
                    </a>
                @endforeach
                <hr>
                
                <a href="{{ route('painel.index') }}" class="btn btn-danger">Limpar Filtros</a>
            </div>
        </div>

        <h2>Registros</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sortable">
                 <thead class="table-dark">
                    <tr>
                        <th>
                            @php $newDirection = ($sortBy == 'senha' && $direction == 'asc') ? 'desc' : 'asc'; @endphp
                            <a href="{{ route('painel.index', array_merge(request()->query(), ['sort_by' => 'senha', 'direction' => $newDirection])) }}">
                                Senha @if($sortBy == 'senha') {{ $direction == 'asc' ? '▲' : '▼' }} @endif
                            </a>
                        </th>
                        <th>Tipo</th>
                        <th>
                            @php $newDirection = ($sortBy == 'horario' && $direction == 'asc') ? 'desc' : 'asc'; @endphp
                            <a href="{{ route('painel.index', array_merge(request()->query(), ['sort_by' => 'horario', 'direction' => $newDirection])) }}">
                                Horário @if($sortBy == 'horario') {{ $direction == 'asc' ? '▲' : '▼' }} @endif
                            </a>
                        </th>
                        <th>Categoria</th>
                        <th>
                            @php $newDirection = ($sortBy == 'quantidade_pessoas' && $direction == 'asc') ? 'desc' : 'asc'; @endphp
                            <a href="{{ route('painel.index', array_merge(request()->query(), ['sort_by' => 'quantidade_pessoas', 'direction' => $newDirection])) }}">
                                Pessoas @if($sortBy == 'quantidade_pessoas') {{ $direction == 'asc' ? '▲' : '▼' }} @endif
                            </a>
                        </th>
                        <th>
                            @php $newDirection = ($sortBy == 'created_at' && $direction == 'asc') ? 'desc' : 'asc'; @endphp
                            <a href="{{ route('painel.index', array_merge(request()->query(), ['sort_by' => 'created_at', 'direction' => $newDirection])) }}">
                                Data/Hora @if($sortBy == 'created_at') {{ $direction == 'asc' ? '▲' : '▼' }} @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registros as $registro)
                        <tr>
                            <td><span class="ticket-font">{{ $registro->senha ?? 'N/A' }}</span></td>
                            <td>{{ ucwords(str_replace('-', ' ', $registro->tipo_fluxo)) }}</td>
                            <td>{{ $registro->horario ?? 'N/A' }}</td>
                            <td>
                                @if($registro->categoria_embarque)
                                    @php
                                        $badgeColor = 'bg-secondary';
                                        switch ($registro->categoria_embarque) {
                                            case 'com-passagem': $badgeColor = 'bg-success'; break;
                                            case 'sem-passagem': $badgeColor = 'bg-warning text-dark'; break;
                                            case 'prioridade-por-lei': $badgeColor = 'bg-danger'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">{{ ucwords(str_replace('-', ' ', $registro->categoria_embarque)) }}</span>
                                @else
                                    <span class="badge bg-light text-dark">N/A</span>
                                @endif
                            </td>
                            <td>{{ $registro->quantidade_pessoas }}</td>
                            <td>{{ $registro->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum registro encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($registros->count() > 0)
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4">TOTAIS DA VISUALIZAÇÃO ATUAL:</th>
                        <th>{{ $totalPessoasFiltradas }} Pessoas</th>
                        <th>{{ $totalRegistrosFiltrados }} Veículos</th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</body>
</html>