<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\PainelController;

// Tela inicial
Route::get('/', [TerminalController::class, 'index'])->name('terminal.index');

// NOVA ROTA: Mostra a tela de horários. O {fluxo} será 'embarcar' or 'deixar-passageiro'
Route::get('/horario/{fluxo}', [TerminalController::class, 'selecionarHorario'])->name('terminal.horario');

// --- FLUXO DE EMBARQUE (Opção 1) ---
// ROTA ATUALIZADA: Agora espera um parâmetro de horário
Route::get('/embarcar/opcoes/{horario}', [TerminalController::class, 'opcoesEmbarque'])->name('terminal.embarcar.opcoes');

// ROTA ATUALIZADA: Também espera o horário
Route::get('/embarcar/quantidade/{horario}/{tipo}', [TerminalController::class, 'selecionarQuantidade'])->name('terminal.embarcar.quantidade');

Route::post('/registrar-embarque', [TerminalController::class, 'registrarEmbarque'])->name('terminal.embarcar.registrar');


// --- FLUXO DE NÃO EMBARQUE (Opções 2 e 3) ---
// Rota para a opção 2 (Não irei embarcar), que não tem horário
Route::get('/saida/nao-embarcar', [TerminalController::class, 'telaQuantidadeNaoEmbarcar'])->name('terminal.saida.nao-embarcar');

// ROTA ATUALIZADA: Rota para a opção 3 (Deixar passageiro), que agora tem horário
Route::get('/saida/deixar-passageiro/{horario}', [TerminalController::class, 'telaQuantidadeDeixarPassageiro'])->name('terminal.saida.deixar-passageiro');

Route::post('/registrar-saida', [TerminalController::class, 'registrarSaida'])->name('terminal.saida.registrar');
Route::get('/painel', [PainelController::class, 'index'])->name('painel.index');