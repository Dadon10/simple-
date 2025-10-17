<?php

namespace App\Exports;

use App\Models\NapsaContribution;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReconciliationExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return NapsaContribution::select('employee_id','month','employee_contrib','employer_contrib','total_contrib','reconciled')->get();
    }

    public function headings(): array
    {
        return ['Employee ID','Month','Employee Contrib','Employer Contrib','Total','Reconciled'];
    }
}
