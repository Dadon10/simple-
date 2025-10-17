<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayslipMail;

class PayslipController extends Controller
{
    public function generate(Payroll $payroll)
    {
        $payroll->load('employee');
        $pdf = Pdf::loadView('payslips.pdf', ['payroll' => $payroll]);
        $fileName = 'payslips/'.now()->format('Ym')."/payslip-{$payroll->id}.pdf";
        Storage::disk('public')->put($fileName, $pdf->output());

        $payslip = Payslip::updateOrCreate(
            ['payroll_id' => $payroll->id, 'employee_id' => $payroll->employee_id],
            ['pdf_path' => $fileName]
        );

        return response()->download(storage_path('app/public/'.$fileName));
    }

    public function email(Payroll $payroll)
    {
        $payroll->load('employee');
        $payslip = $payroll->payslip;
        if (! $payslip) {
            $this->generate($payroll);
            $payslip = $payroll->fresh()->payslip;
        }

        Mail::to($payroll->employee->email)->send(new PayslipMail($payslip));
        return back()->with('success', 'Payslip emailed');
    }
}
