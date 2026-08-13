<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceRequestController extends Controller
{
    private const STATUS_TO_DATABASE = [
        'aberta' => 'open',
        'em_andamento' => 'in_progress',
        'encerrada' => 'closed',
        'cancelada' => 'canceled',
    ];

    private const STATUS_FROM_DATABASE = [
        'open' => 'aberta',
        'in_progress' => 'em_andamento',
        'closed' => 'encerrada',
        'canceled' => 'cancelada',
    ];

    public function index(Request $request)
    {
        $query = ServiceRequest::with(['company', 'department', 'user'])
            ->latest('date_opened');

        if ($request->filled('busca')) {
            $query->where('description', 'like', '%' . $request->string('busca') . '%');
        }

        if ($request->filled('status') && isset(self::STATUS_TO_DATABASE[$request->status])) {
            $query->where('status', self::STATUS_TO_DATABASE[$request->status]);
        }

        if ($request->filled('prioridade') && in_array($request->prioridade, ['baixa', 'media', 'alta'], true)) {
            $query->where('priority', $request->prioridade);
        }

        $requisicoes = $query->get()->map(fn(ServiceRequest $item) => $this->toViewModel($item))->all();

        return view('service_requests.index', [
            'requisicoes' => $requisicoes,
            'total' => ServiceRequest::count(),
            'abertas' => ServiceRequest::where('status', 'open')->count(),
            'emAndamento' => ServiceRequest::where('status', 'in_progress')->count(),
            'encerradas' => ServiceRequest::where('status', 'closed')->count(),
        ]);
    }

    public function dashboard()
    {
        $recentRequests = ServiceRequest::with(['company', 'department', 'user'])
            ->latest('date_opened')
            ->take(5)
            ->get()
            ->map(fn(ServiceRequest $item) => $this->toViewModel($item));

        return view('dashboard', [
            'total' => ServiceRequest::count(),
            'abertas' => ServiceRequest::where('status', 'open')->count(),
            'emAndamento' => ServiceRequest::where('status', 'in_progress')->count(),
            'encerradas' => ServiceRequest::where('status', 'closed')->count(),
            'canceladas' => ServiceRequest::where('status', 'canceled')->count(),
            'recentRequests' => $recentRequests,
        ]);
    }

    public function create()
    {
        $companies = Company::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $departments = Department::query()
            ->where('is_active', true)
            ->with('company')
            ->orderBy('name')
            ->get();

        return view('service_requests.create', compact('companies', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'empresa_id' => [
                    'required',
                    'integer',
                    Rule::exists('companies', 'id')->where(fn($query) => $query->where('is_active', true)),
                ],
                'departamento_id' => [
                    'required',
                    'integer',
                    Rule::exists('departments', 'id')->where(fn($query) => $query->where('is_active', true)),
                ],
                'prioridade' => ['required', 'in:baixa,media,alta'],
                'descricao' => ['required', 'string', 'min:10', 'max:500'],
            ],
            [
                'empresa_id.required' => 'Empresa é obrigatória.',
                'empresa_id.exists' => 'Selecione uma empresa ativa cadastrada.',
                'departamento_id.required' => 'Departamento é obrigatório.',
                'departamento_id.exists' => 'Selecione um departamento ativo cadastrado.',
                'prioridade.required' => 'Prioridade é obrigatória.',
                'descricao.required' => 'Descrição é obrigatória.',
                'descricao.min' => 'Descrição deve ter no mínimo 10 caracteres.',
                'descricao.max' => 'Descrição não pode exceder 500 caracteres.',
            ]
        );

        $userId = auth()->id() ?: User::query()->value('id');

        if (!$userId) {
            return back()
                ->withInput()
                ->with('error', 'Cadastre um usuário antes de abrir uma requisição.');
        }

        ServiceRequest::create([
            'company_id' => $validated['empresa_id'],
            'department_id' => $validated['departamento_id'],
            'user_id' => $userId,
            'date_opened' => now(),
            'description' => $validated['descricao'],
            'priority' => $validated['prioridade'],
            'status' => 'open',
        ]);

        return redirect()
            ->route('servicerequest.index')
            ->with('success', 'Requisição criada com sucesso!');
    }

    public function show($id)
    {
        $serviceRequest = ServiceRequest::with(['company', 'department', 'user'])->find($id);

        if (!$serviceRequest) {
            return redirect()->route('servicerequest.index')->with('error', 'Requisição não encontrada.');
        }

        return view('service_requests.show', [
            'serviceRequest' => $this->toViewModel($serviceRequest),
        ]);
    }

    public function edit($id)
    {
        $serviceRequest = ServiceRequest::with(['company', 'department', 'user'])->find($id);

        if (!$serviceRequest) {
            return redirect()->route('servicerequest.index')->with('error', 'Requisição não encontrada.');
        }

        return view('service_requests.edit', [
            'serviceRequest' => $this->toViewModel($serviceRequest),
        ]);
    }

    public function update(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::find($id);

        if (!$serviceRequest) {
            return redirect()->route('servicerequest.index')->with('error', 'Requisição não encontrada.');
        }

        $validated = $request->validate([
            'prioridade' => ['required', 'in:baixa,media,alta'],
            'descricao' => ['required', 'string', 'min:10', 'max:500'],
            'status' => ['required', Rule::in(array_keys(self::STATUS_TO_DATABASE))],
        ]);

        $databaseStatus = self::STATUS_TO_DATABASE[$validated['status']];

        $serviceRequest->update([
            'priority' => $validated['prioridade'],
            'description' => $validated['descricao'],
            'status' => $databaseStatus,
            'date_closed' => $databaseStatus === 'closed' ? now() : null,
        ]);

        return redirect()
            ->route('servicerequest.show', $id)
            ->with('success', 'Requisição atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $serviceRequest = ServiceRequest::find($id);

        if (!$serviceRequest) {
            return redirect()->route('servicerequest.index')->with('error', 'Requisição não encontrada.');
        }

        $serviceRequest->delete();

        return redirect()
            ->route('servicerequest.index')
            ->with('success', 'Requisição excluída com sucesso.');
    }

    public function trashed()
    {
        $serviceRequests = ServiceRequest::onlyTrashed()
            ->with(['company', 'department', 'user'])
            ->latest('date_opened')
            ->get()
            ->map(fn(ServiceRequest $item) => $this->toViewModel($item));

        return view('service_requests.trashed', compact('serviceRequests'));
    }

    public function restore($id)
    {
        $serviceRequest = ServiceRequest::onlyTrashed()->find($id);

        if (!$serviceRequest) {
            return redirect()->route('service_requests.trashed')->with('error', 'Requisição não encontrada.');
        }

        $serviceRequest->restore();

        return redirect()->route('service_requests.trashed')->with('success', 'Requisição restaurada com sucesso.');
    }

    public function forceDelete($id)
    {
        $serviceRequest = ServiceRequest::onlyTrashed()->find($id);

        if (!$serviceRequest) {
            return redirect()->route('service_requests.trashed')->with('error', 'Requisição não encontrada.');
        }

        $serviceRequest->forceDelete();

        return redirect()->route('service_requests.trashed')->with('success', 'Requisição excluída permanentemente.');
    }

    private function toViewModel(ServiceRequest $serviceRequest): object
    {
        return (object) [
            'id' => $serviceRequest->id,
            'empresa' => $serviceRequest->company?->name ?? 'N/A',
            'departamento' => $serviceRequest->department?->name ?? 'N/A',
            'descricao' => $serviceRequest->description,
            'prioridade' => $serviceRequest->priority ?? 'media',
            'status' => self::STATUS_FROM_DATABASE[$serviceRequest->status] ?? 'aberta',
            'data' => $serviceRequest->date_opened?->format('Y-m-d') ?? $serviceRequest->date_opened,
            'created_at' => $serviceRequest->created_at,
            'updated_at' => $serviceRequest->updated_at,
        ];
    }
}
