<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\NapsaContribution;

class PayrollCalculator
{
    private const NAPSA_RATE_EMPLOYEE = 0.05; // 5%
    private const NAPSA_RATE_EMPLOYER = 0.05; // 5%
    private const NAPSA_CEILING = 23000.00; // example monthly ceiling (ZMW); adjust as needed

    public function computeForEmployeeMonth(Employee $employee, string $month, float $deductions = 0): array
    {
        $grossSalary = (float) $employee->basic_salary;
        $cappedSalary = min($grossSalary, self::NAPSA_CEILING);

        $employeeNapsa = round($cappedSalary * self::NAPSA_RATE_EMPLOYEE, 2);
        $employerNapsa = round($cappedSalary * self::NAPSA_RATE_EMPLOYER, 2);
        $totalNapsa = round($employeeNapsa + $employerNapsa, 2);

        $netSalary = round($grossSalary - $employeeNapsa - $deductions, 2);

        return [
            'gross_salary' => $grossSalary,
            'deductions' => $deductions + $employeeNapsa,
            'net_salary' => $netSalary,
            'employee_contrib' => $employeeNapsa,
            'employer_contrib' => $employerNapsa,
            'total_contrib' => $totalNapsa,
        ];
    }

    public function createPayrollAndNapsa(Employee $employee, string $month, float $deductions = 0): Payroll
    {
        $calc = $this->computeForEmployeeMonth($employee, $month, $deductions);

        $payroll = Payroll::updateOrCreate(
            ['employee_id' => $employee->id, 'month' => $month],
            [
                'gross_salary' => $calc['gross_salary'],
                'deductions' => $calc['deductions'],
                'net_salary' => $calc['net_salary'],
            ]
        );

        NapsaContribution::updateOrCreate(
            ['employee_id' => $employee->id, 'month' => $month],
            [
                'employee_contrib' => $calc['employee_contrib'],
                'employer_contrib' => $calc['employer_contrib'],
                'total_contrib' => $calc['total_contrib'],
            ]
        );

        return $payroll;
    }
}
