<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = \App\Models\Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = \App\Models\Company::all();
        return view('departments.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'is_active' => 'required|boolean'
        ]);

        \App\Models\Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Departamento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = \App\Models\Department::findOrFail($id);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = \App\Models\Department::findOrFail($id);
        $companies = \App\Models\Company::all();
        return view('departments.edit', compact('department', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = \App\Models\Department::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'is_active' => 'required|boolean'
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Departamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = \App\Models\Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Departamento deletado com sucesso.');
    }

    public function trashed()
    {
        $departments = \App\Models\Department::onlyTrashed()->get();

        return view('departments.trashed', compact('departments'));
    }
    public function restore(string $id)
    {
        $department = \App\Models\Department::onlyTrashed()->findOrFail($id);
        $department->restore();

        return redirect()->route('departments.trashed')->with('success', 'Departamento restaurado com sucesso.');
    }
    public function forceDelete(string $id)
    {
        $department = \App\Models\Department::onlyTrashed()->findOrFail($id);
        $department->forceDelete();

        return redirect()->route('departments.trashed')->with('success', 'Departamento deletado permanentemente.');
    }

}
