<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\NapsaContribution;
use App\Services\PayrollCalculator;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = collect([
            Employee::firstOrCreate(
                ['email' => 'john.banda@sanlam.test'],
                [
                    'name' => 'John Banda',
                    'email' => 'john.banda@sanlam.test',
                    'napsa_number' => 'NAPSA001',
                    'position' => 'Underwriter',
                    'basic_salary' => 18000,
                ]
            ),
            Employee::firstOrCreate(
                ['email' => 'mary.zulu@sanlam.test'],
                [
                    'name' => 'Mary Zulu',
                    'email' => 'mary.zulu@sanlam.test',
                    'napsa_number' => 'NAPSA002',
                    'position' => 'Actuary',
                    'basic_salary' => 26000,
                ]
            ),
            Employee::firstOrCreate(
                ['email' => 'peter.mwale@sanlam.test'],
                [
                    'name' => 'Peter Mwale',
                    'email' => 'peter.mwale@sanlam.test',
                    'napsa_number' => 'NAPSA003',
                    'position' => 'Claims Officer',
                    'basic_salary' => 14000,
                ]
            ),
        ]);

        $calculator = new PayrollCalculator();
        $month = now()->format('Y-m');

        foreach ($employees as $employee) {
            $calculator->createPayrollAndNapsa($employee, $month, deductions: 500);
        }
    }
}
