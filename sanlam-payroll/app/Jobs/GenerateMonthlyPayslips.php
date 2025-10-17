<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Payroll;
use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayslipMail;

class GenerateMonthlyPayslips implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $month = now()->subMonthNoOverflow()->format('Y-m');
        $payrolls = Payroll::with('employee')->where('month', $month)->get();

        foreach ($payrolls as $payroll) {
            $pdf = Pdf::loadView('payslips.pdf', ['payroll' => $payroll]);
            $fileName = 'payslips/'.$month."/payslip-{$payroll->id}.pdf";
            Storage::disk('public')->put($fileName, $pdf->output());

            $payslip = Payslip::updateOrCreate(
                ['payroll_id' => $payroll->id, 'employee_id' => $payroll->employee_id],
                ['pdf_path' => $fileName]
            );

            if ($payroll->employee?->email) {
                Mail::to($payroll->employee->email)->send(new PayslipMail($payslip));
            }
        }
    }
}
