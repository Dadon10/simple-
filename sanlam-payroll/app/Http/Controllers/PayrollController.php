<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $payrolls = Payroll::with('employee')->latest()->paginate(10);
        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employees = Employee::orderBy('name')->get();
        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollRequest $request): RedirectResponse
    {
        Payroll::create($request->validated());
        return redirect()->route('payrolls.index')->with('success', 'Payroll created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll): View
    {
        $payroll->load('employee');
        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll): View
    {
        $employees = Employee::orderBy('name')->get();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollRequest $request, Payroll $payroll): RedirectResponse
    {
        $payroll->update($request->validated());
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll): RedirectResponse
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted');
    }
}
