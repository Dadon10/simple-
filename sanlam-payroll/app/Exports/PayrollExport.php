<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payroll::select('employee_id','month','gross_salary','deductions','net_salary')->get();
    }

    public function headings(): array
    {
        return ['Employee ID','Month','Gross Salary','Deductions','Net Salary'];
    }
}
