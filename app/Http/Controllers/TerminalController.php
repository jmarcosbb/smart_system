<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class TerminalController extends Controller
{
    /**
     * ✅ ESTE É O MÉTODO QUE ESTÁ FALTANDO.
     * Mostra a tela inicial com as 3 opções.
     */
    public function index()
    {
        return view('terminal.index');
    }

    public function selecionarHorario($fluxo)
    {
        $horarios = [
            '03:00', '05:00', '07:00', '08:00', '10:00', '12:00',
            '13:00', '14:00', '15:30', '18:00', '20:00'
        ];

        return view('terminal.horarios', [
            'horarios' => $horarios,
            'fluxo' => $fluxo
        ]);
    }

    /**
     * Mostra as opções de embarque (tela 2).
     */
// VERSÃO CORRETA
    public function opcoesEmbarque($horario)
    {
        // Agora a view 'opcoes_embarque' receberá uma variável chamada 'horario'.
        return view('terminal.opcoes_embarque', ['horario' => $horario]);
    }

    /**
     * Mostra a tela para o usuário inserir a quantidade de pessoas.
     * @param string $tipo O tipo de embarque escolhido na tela anterior.
     */
    public function selecionarQuantidade($horario, $tipo)
{
    $tipoDisplay = ucwords(str_replace('-', ' ', $tipo));

    return view('terminal.quantidade_pessoas', [
        'horario' => $horario, // Adicione esta linha
        'tipo' => $tipo,
        'tipoDisplay' => $tipoDisplay
    ]);
}

    /**
     * Recebe os dados do formulário e mostra a confirmação final.
     * @param Request $request Os dados enviados pelo formulário.
     */

        private function gerarProximaSenha()
    {
        // Busca o último registro pela ID para garantir que é o mais recente
        $ultimoRegistro = Registro::latest('id')->first();

        // Se houver um registro e ele tiver uma senha, incremente. Senão, comece do 1.
        $proximoNumero = ($ultimoRegistro && $ultimoRegistro->senha) ? (int)$ultimoRegistro->senha + 1 : 1;

        // Formata o número para ter 5 dígitos com zeros à esquerda (ex: 00001)
        return str_pad($proximoNumero, 5, '0', STR_PAD_LEFT);
    }
    public function registrarEmbarque(Request $request)
    {
        $registro = new Registro();
        $registro->tipo_fluxo = 'embarque';
        $registro->horario = $request->horario;
        $registro->categoria_embarque = $request->tipo;
        $registro->quantidade_pessoas = $request->quantidade;
        
        // Usa o novo método para gerar a senha sequencial
        $registro->senha = $this->gerarProximaSenha();
        $registro->codigo_barras = rand(100000000000, 999999999999);
        
        $registro->save();
        
        return view('terminal.ticket_barcode', [
            'senha' => $registro->senha,
            'barcode' => $registro->codigo_barras,
            'horario' => $request->horario,
            'tipoDisplay' => ucwords(str_replace('-', ' ', $request->tipo)),
            'quantidade' => $request->quantidade
        ]);
    }

    public function telaQuantidadeSaida($horario = null, $tipo = 'nao-embarcar')
    {
        $textos = [
            'nao-embarcar' => [
                'titulo' => 'Não Irei Embarcar',
                'pergunta' => 'Por favor, informe a quantidade de pessoas no seu veículo:'
            ],
            'deixar-passageiro' => [
                'titulo' => 'Deixar Passageiro(s)',
                'pergunta' => 'Por favor, informe quantos passageiros você está deixando no terminal:'
            ]
        ];
        
        // Se o tipo não for passado pela URL, pegamos o segundo parâmetro
        if ($horario && in_array($horario, ['nao-embarcar', 'deixar-passageiro'])) {
            $tipo = $horario;
            $horario = null;
        }

        return view('terminal.quantidade_saida', [
            'tipo' => $tipo,
            'horario' => $horario, // Pode ser null
            'titulo' => $textos[$tipo]['titulo'],
            'pergunta' => $textos[$tipo]['pergunta']
        ]);
    }

    public function registrarSaida(Request $request)
    {
        $registro = new Registro();
        $registro->tipo_fluxo = $request->tipo;
        $registro->horario = $request->horario;
        $registro->quantidade_pessoas = $request->quantidade;

        // Usa o novo método para gerar a senha sequencial
        $registro->senha = $this->gerarProximaSenha();
        $registro->codigo_barras = rand(100000000000, 999999999999);
        
        $registro->save();

        return view('terminal.ticket_barcode', [
            'senha' => $registro->senha,
            'barcode' => $registro->codigo_barras,
            'horario' => $request->horario
        ]);
    }
    public function telaQuantidadeNaoEmbarcar()
    {
        return view('terminal.quantidade_saida', [
            'tipo' => 'nao-embarcar',
            'horario' => null,
            'titulo' => 'Não Irei Embarcar',
            'pergunta' => 'Por favor, informe a quantidade de pessoas no seu veículo:'
        ]);
    }

    public function telaQuantidadeDeixarPassageiro($horario)
    {
        return view('terminal.quantidade_saida', [
            'tipo' => 'deixar-passageiro',
            'horario' => $horario,
            'titulo' => 'Deixar Passageiro(s)',
            'pergunta' => 'Por favor, informe quantos passageiros você está deixando no terminal:'
        ]);
    }
    
}