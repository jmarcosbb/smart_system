<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class PainelController extends Controller
{

    public function index(Request $request)
    {
        // Lógica de Ordenação (sem alterações)
        $sortableColumns = ['senha', 'horario', 'quantidade_pessoas', 'created_at'];
        $sortBy = $request->input('sort_by', 'created_at');
        $direction = $request->input('direction', 'desc');
        if (!in_array($sortBy, $sortableColumns)) {
            $sortBy = 'created_at';
        }

        // Lógica de Filtragem (sem alterações)
        $query = Registro::query();
        if ($request->has('fluxo')) { $query->where('tipo_fluxo', $request->fluxo); }
        if ($request->has('horario')) { $query->where('horario', $request->horario); }
        if ($request->has('categoria')) { $query->where('categoria_embarque', $request->categoria); }
        $registros = $query->orderBy($sortBy, $direction)->get();

        // Busca de Dados para os Botões de Filtro (sem alterações)
        $categoriasDisponiveis = Registro::whereNotNull('categoria_embarque')->distinct()->pluck('categoria_embarque');
        
        // ================== ALTERAÇÃO AQUI ==================
        // Busca os horários disponíveis e já os ordena
        $horariosDisponiveis = Registro::whereNotNull('horario')->distinct()->pluck('horario')->sort();

        // Cálculo de Totais para os Botões
        $totais = [
            'fluxo' => [
                'embarque' => Registro::where('tipo_fluxo', 'embarque')->count(),
                'deixar-passageiro' => Registro::where('tipo_fluxo', 'deixar-passageiro')->count(),
                'nao-embarcar' => Registro::where('tipo_fluxo', 'nao-embarcar')->count(),
            ],
            'categoria' => [],
            'horario' => [] // Adiciona a chave para os totais de horário
        ];
        foreach ($categoriasDisponiveis as $categoria) {
            $totais['categoria'][$categoria] = Registro::where('categoria_embarque', $categoria)->count();
        }
        // Preenche os totais para cada horário encontrado
        foreach ($horariosDisponiveis as $horario) {
            $totais['horario'][$horario] = Registro::where('horario', $horario)->count();
        }
        // ================== FIM DA ALTERAÇÃO ==================

        // Cálculo de Totais para o Rodapé da Tabela (sem alterações)
        $totalRegistrosFiltrados = $registros->count();
        $totalPessoasFiltradas = $registros->sum('quantidade_pessoas');

        // Envia todos os dados para a View
        return view('painel.index', [
            'registros' => $registros,
            'horariosDisponiveis' => $horariosDisponiveis,
            'categoriasDisponiveis' => $categoriasDisponiveis,
            'sortBy' => $sortBy,
            'direction' => $direction,
            'totais' => $totais,
            'totalRegistrosFiltrados' => $totalRegistrosFiltrados,
            'totalPessoasFiltradas' => $totalPessoasFiltradas
        ]);
    }
}