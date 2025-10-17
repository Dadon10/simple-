<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NapsaContribution;
use App\Models\Payroll;

class ReconcileNapsaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'napsa:reconcile {month?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compare payroll vs NAPSA contributions and flag discrepancies';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $month = $this->argument('month') ?? now()->format('Y-m');

        $discrepancies = [];
        $napsa = NapsaContribution::where('month', $month)->with('employee')->get();

        foreach ($napsa as $row) {
            $payroll = Payroll::where('employee_id', $row->employee_id)
                ->where('month', $month)
                ->first();

            if (! $payroll) {
                $discrepancies[] = [
                    'employee' => $row->employee->name,
                    'reason' => 'Missing payroll record',
                ];
                continue;
            }

            $capped = min($payroll->gross_salary, 23000);
            $expected = round($capped * 0.10, 2);
            if (abs($row->total_contrib - $expected) > 0.01) {
                $discrepancies[] = [
                    'employee' => $row->employee->name,
                    'reason' => 'Total NAPSA mismatch',
                ];
            }
        }

        if (empty($discrepancies)) {
            $this->info('No discrepancies for ' . $month);
        } else {
            foreach ($discrepancies as $d) {
                $this->warn($d['employee'] . ': ' . $d['reason']);
            }
        }

        return self::SUCCESS;
    }
}
