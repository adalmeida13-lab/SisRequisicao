<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    // Dados simulados em memória (sem banco de dados ainda)
    private static $requisicoes = [];

    public function __construct()
    {
        // Simular alguns dados iniciais
        if (empty(self::$requisicoes)) {
            self::$requisicoes = [
                [
                    'id' => 1,
                    'empresa' => 'Empresa A',
                    'departamento' => 'TI',
                    'descricao' => 'Instalar softwares no computador da sala 101',
                    'prioridade' => 'alta',
                    'status' => 'aberta',
                    'data' => '2026-08-12'
                ],
                [
                    'id' => 2,
                    'empresa' => 'Empresa B',
                    'departamento' => 'RH',
                    'descricao' => 'Configurar acesso de novo funcionário ao sistema',
                    'prioridade' => 'media',
                    'status' => 'em_andamento',
                    'data' => '2026-08-11'
                ],
                [
                    'id' => 3,
                    'empresa' => 'Empresa C',
                    'departamento' => 'Financeiro',
                    'descricao' => 'Relatório mensal de despesas departamentais',
                    'prioridade' => 'baixa',
                    'status' => 'encerrada',
                    'data' => '2026-08-10'
                ]
            ];
        }
    }

    /**
     * Listagem de requisições com filtros
     */
    public function index(Request $request)
    {
        $query = self::$requisicoes;

        // FILTRO POR BUSCA (descrição)
        $busca = $request->get('busca');
        if ($busca) {
            $query = array_filter($query, function ($req) use ($busca) {
                return stripos($req['descricao'], $busca) !== false;
            });
        }

        // FILTRO POR STATUS
        $status = $request->get('status');
        if ($status) {
            $query = array_filter($query, function ($req) use ($status) {
                return $req['status'] === $status;
            });
        }

        // FILTRO POR PRIORIDADE
        $prioridade = $request->get('prioridade');
        if ($prioridade) {
            $query = array_filter($query, function ($req) use ($prioridade) {
                return $req['prioridade'] === $prioridade;
            });
        }

        // Converter arrays para objetos para compatibilidade com Blade
        $requisicoes = collect($query)->map(function ($req) {
            return (object) $req;
        })->toArray();

        // ESTATÍSTICAS
        $total = count(self::$requisicoes);
        $abertas = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'aberta'));
        $emAndamento = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'em_andamento'));
        $encerradas = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'encerrada'));

        return view('service_requests.index', [
            'requisicoes' => $requisicoes,
            'total' => $total,
            'abertas' => $abertas,
            'emAndamento' => $emAndamento,
            'encerradas' => $encerradas
        ]);
    }

    /**
     * Painel inicial com um resumo das requisições.
     */
    public function dashboard()
    {
        $total = count(self::$requisicoes);
        $abertas = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'aberta'));
        $emAndamento = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'em_andamento'));
        $encerradas = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'encerrada'));
        $canceladas = count(array_filter(self::$requisicoes, fn($r) => $r['status'] === 'cancelada'));

        $recentRequests = collect(self::$requisicoes)
            ->sortByDesc('data')
            ->take(5)
            ->map(fn($request) => (object) $request)
            ->values();

        return view('dashboard', compact(
            'total',
            'abertas',
            'emAndamento',
            'encerradas',
            'canceladas',
            'recentRequests'
        ));
    }

    /**
     * Formulário para criar nova requisição
     */
    public function create()
    {
        return view('service_requests.create');
    }

    /**
     * Validar e salvar nova requisição
     */
    public function store(Request $request)
    {
        // VALIDAÇÃO EM PHP/LARAVEL
        $validated = $request->validate(
            [
                'empresa_id' => 'required|integer|min:1',
                'departamento_id' => 'required|integer|min:1',
                'prioridade' => 'required|in:baixa,media,alta',
                'descricao' => 'required|string|min:10|max:500'
            ],
            [
                'empresa_id.required' => 'Empresa é obrigatória',
                'empresa_id.integer' => 'Empresa inválida',
                'departamento_id.required' => 'Departamento é obrigatório',
                'departamento_id.integer' => 'Departamento inválido',
                'prioridade.required' => 'Prioridade é obrigatória',
                'prioridade.in' => 'Prioridade deve ser: baixa, média ou alta',
                'descricao.required' => 'Descrição é obrigatória',
                'descricao.min' => 'Descrição deve ter no mínimo 10 caracteres',
                'descricao.max' => 'Descrição não pode exceder 500 caracteres'
            ]
        );

        // Dados de mapeamento
        $empresas = ['1' => 'Empresa A', '2' => 'Empresa B', '3' => 'Empresa C'];
        $departamentos = ['1' => 'TI', '2' => 'RH', '3' => 'Financeiro', '4' => 'Operações'];

        // CRIAR NOVA REQUISIÇÃO
        $novaRequisicao = [
            'id' => count(self::$requisicoes) + 1,
            'empresa' => $empresas[$request->empresa_id] ?? 'N/A',
            'departamento' => $departamentos[$request->departamento_id] ?? 'N/A',
            'descricao' => $validated['descricao'],
            'prioridade' => $validated['prioridade'],
            'status' => 'aberta',
            'data' => date('Y-m-d')
        ];

        // Adicionar ao array
        self::$requisicoes[] = $novaRequisicao;

        // MENSAGEM DE SUCESSO
        return redirect()
            ->route('servicerequest.index')
            ->with('success', 'Requisição criada com sucesso! Você pode acompanhar seu status na listagem.');
    }

    /**
     * Visualizar detalhes da requisição
     */
    public function show($id)
    {
        $requisicao = collect(self::$requisicoes)->firstWhere('id', $id);

        if (!$requisicao) {
            return redirect()
                ->route('servicerequest.index')
                ->with('error', 'Requisição não encontrada');
        }

        // Converter para objeto para compatibilidade com Blade
        $serviceRequest = (object) $requisicao;

        return view('service_requests.show', ['serviceRequest' => $serviceRequest]);
    }

    /**
     * Formulário para editar requisição
     */
    public function edit($id)
    {
        $requisicao = collect(self::$requisicoes)->firstWhere('id', $id);

        if (!$requisicao) {
            return redirect()
                ->route('servicerequest.index')
                ->with('error', 'Requisição não encontrada');
        }

        // Converter para objeto para compatibilidade com Blade
        $serviceRequest = (object) $requisicao;

        return view('service_requests.edit', ['serviceRequest' => $serviceRequest]);
    }

    /**
     * Atualizar requisição
     */
    public function update(Request $request, $id)
    {
        $requisicao = collect(self::$requisicoes)->firstWhere('id', $id);

        if (!$requisicao) {
            return redirect()
                ->route('servicerequest.index')
                ->with('error', 'Requisição não encontrada');
        }

        // VALIDAÇÃO
        $validated = $request->validate([
            'prioridade' => 'required|in:baixa,media,alta',
            'descricao' => 'required|string|min:10|max:500',
            'status' => 'required|in:aberta,em_andamento,encerrada,cancelada'
        ]);

        // Atualizar
        $index = array_search($requisicao, self::$requisicoes);
        self::$requisicoes[$index]['prioridade'] = $validated['prioridade'];
        self::$requisicoes[$index]['descricao'] = $validated['descricao'];
        self::$requisicoes[$index]['status'] = $validated['status'];

        return redirect()
            ->route('servicerequest.show', $id)
            ->with('success', 'Requisição atualizada com sucesso!');
    }

    /**
     * Deletar requisição
     */
    public function destroy($id)
    {
        $requisicao = collect(self::$requisicoes)->firstWhere('id', $id);

        if (!$requisicao) {
            return redirect()
                ->route('servicerequest.index')
                ->with('error', 'Requisição não encontrada');
        }

        // Remover do array
        self::$requisicoes = array_filter(
            self::$requisicoes,
            fn($req) => $req['id'] !== $id
        );

        return redirect()
            ->route('servicerequest.index')
            ->with('success', 'Requisição deletada com sucesso!');
    }
}
