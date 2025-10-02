<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class PainelController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. Lógica de Ordenação ---
        $sortableColumns = ['senha', 'horario', 'quantidade_pessoas', 'created_at'];
        $sortBy = $request->input('sort_by', 'created_at');
        $direction = $request->input('direction', 'desc');

        if (!in_array($sortBy, $sortableColumns)) {
            $sortBy = 'created_at';
        }

        // --- 2. Lógica de Filtragem ---
        $query = Registro::query();
        if ($request->has('fluxo')) { $query->where('tipo_fluxo', $request->fluxo); }
        if ($request->has('horario')) { $query->where('horario', $request->horario); }
        if ($request->has('categoria')) { $query->where('categoria_embarque', $request->categoria); }
        
        // Aplica a ordenação e busca os registros
        $registros = $query->orderBy($sortBy, $direction)->get();

        // --- 3. Busca de Dados para os Botões de Filtro ---
        $horariosDisponiveis = Registro::whereNotNull('horario')->distinct()->pluck('horario')->sort();
        $categoriasDisponiveis = Registro::whereNotNull('categoria_embarque')->distinct()->pluck('categoria_embarque');
        
        // --- 4. Cálculo de Totais para os Botões ---
        $totais = [
            'fluxo' => [
                'embarque' => Registro::where('tipo_fluxo', 'embarque')->count(),
                'deixar-passageiro' => Registro::where('tipo_fluxo', 'deixar-passageiro')->count(),
                'nao-embarcar' => Registro::where('tipo_fluxo', 'nao-embarcar')->count(),
            ],
            'categoria' => []
        ];
        foreach ($categoriasDisponiveis as $categoria) {
            $totais['categoria'][$categoria] = Registro::where('categoria_embarque', $categoria)->count();
        }

        // --- 5. Cálculo de Totais para o Rodapé da Tabela (baseado no filtro) ---
        $totalRegistrosFiltrados = $registros->count();
        $totalPessoasFiltradas = $registros->sum('quantidade_pessoas');

        // --- 6. Envia todos os dados para a View ---
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