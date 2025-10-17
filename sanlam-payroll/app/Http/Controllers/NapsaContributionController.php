<?php

namespace App\Http\Controllers;

use App\Models\NapsaContribution;
use App\Models\Employee;
use App\Http\Requests\StoreNapsaContributionRequest;
use App\Http\Requests\UpdateNapsaContributionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class NapsaContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contributions = NapsaContribution::with('employee')->latest()->paginate(10);
        return view('napsa.index', compact('contributions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employees = Employee::orderBy('name')->get();
        return view('napsa.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNapsaContributionRequest $request): RedirectResponse
    {
        NapsaContribution::create($request->validated());
        return redirect()->route('napsa.index')->with('success', 'Contribution recorded');
    }

    /**
     * Display the specified resource.
     */
    public function show(NapsaContribution $napsaContribution): View
    {
        $napsaContribution->load('employee');
        return view('napsa.show', ['contribution' => $napsaContribution]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NapsaContribution $napsaContribution): View
    {
        $employees = Employee::orderBy('name')->get();
        return view('napsa.edit', ['contribution' => $napsaContribution, 'employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNapsaContributionRequest $request, NapsaContribution $napsaContribution): RedirectResponse
    {
        $napsaContribution->update($request->validated());
        return redirect()->route('napsa.index')->with('success', 'Contribution updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NapsaContribution $napsaContribution): RedirectResponse
    {
        $napsaContribution->delete();
        return redirect()->route('napsa.index')->with('success', 'Contribution deleted');
    }
}
