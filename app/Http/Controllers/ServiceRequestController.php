<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceRequests = \App\Models\ServiceRequest::all();
        return view('service_requests.index', compact('serviceRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = \App\Models\Department::all();
        return view('service_requests.create', compact('departments'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $serviceRequest = new \App\Models\ServiceRequest();
        $serviceRequest->description = $request->input('description');
        $serviceRequest->department_id = $request->input('department_id');
        $serviceRequest->request_date = $request->input('request_date');
        // Set other fields as needed
        $serviceRequest->save();

        return redirect()->action([self::class, 'index'])->with('success', 'Service request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceRequest = \App\Models\ServiceRequest::findOrFail($id);
        return view('service_requests.show', compact('serviceRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceRequest = \App\Models\ServiceRequest::findOrFail($id);
        return view('service_requests.edit', compact('serviceRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $serviceRequest = \App\Models\ServiceRequest::findOrFail($id);
        $serviceRequest->title = $request->input('title');
        $serviceRequest->description = $request->input('description');
        // Set other fields as needed
        $serviceRequest->save();

        return redirect()->action([self::class, 'index'])->with('success', 'Service request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceRequest = \App\Models\ServiceRequest::findOrFail($id);
        $serviceRequest->delete();

        return redirect()->action([self::class, 'index'])->with('success', 'Service request deleted successfully.');
    }
    public function trashed()
    {
        $trashedServiceRequests = \App\Models\ServiceRequest::onlyTrashed()->get();
        return view('service_requests.trashed', compact('trashedServiceRequests'));
    }
    public function restore(string $id)
    {
        $serviceRequest = \App\Models\ServiceRequest::onlyTrashed()->findOrFail($id);
        $serviceRequest->restore();

        return redirect()->action([self::class, 'index'])->with('success', 'Service request restored successfully.');
    }
    public function forceDelete(string $id)
    {
        $serviceRequest = \App\Models\ServiceRequest::onlyTrashed()->findOrFail($id);
        $serviceRequest->forceDelete();

        return redirect()->action([self::class, 'trashed'])->with('success', 'Service request permanently deleted.');
    }
}
