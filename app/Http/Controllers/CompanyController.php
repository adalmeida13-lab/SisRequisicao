<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = \App\Models\Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'docto' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        \App\Models\Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Empresa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = \App\Models\Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = \App\Models\Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = \App\Models\Company::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'docto' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $company->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departmentCount = \App\Models\Department::where('company_id', $id)->count();
        if ($departmentCount > 0) {
            return redirect()->route('companies.index')->with('error', 'Não é possível excluir a empresa, pois existem departamentos associados a ela.');
        }
        $company = \App\Models\Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Empresa excluída com sucesso.');
    }

    public function trashed()
    {
        $companies = \App\Models\Company::onlyTrashed()->get();
        return view('companies.trashed', compact('companies'));
    }
    public function restore(string $id)
    {
        $company = \App\Models\Company::onlyTrashed()->findOrFail($id);
        $company->restore();

        return redirect()->route('companies.trashed')->with('success', 'Empresa restaurada com sucesso.');
    }
    public function forceDelete(string $id)
    {
        $company = \App\Models\Company::onlyTrashed()->findOrFail($id);
        $company->forceDelete();

        return redirect()->route('companies.trashed')->with('success', 'Empresa deletada permanentemente.');
    }

}
