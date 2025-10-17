<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Payslip</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { background: #0076BE; color: white; padding: 10px; }
        .section { margin-top: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #D1D1D1; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <strong>Sanlam Life Insurance</strong> — Payslip
    </div>

    <div class="section">
        <strong>Employee:</strong> {{ $payroll->employee->name }}<br>
        <strong>Email:</strong> {{ $payroll->employee->email }}<br>
        <strong>Month:</strong> {{ $payroll->month }}
    </div>

    <div class="section">
        <table>
            <tr>
                <th>Basic/Gross Salary</th>
                <td>ZMW {{ number_format($payroll->gross_salary, 2) }}</td>
            </tr>
            <tr>
                <th>Deductions (incl. NAPSA employee)</th>
                <td>ZMW {{ number_format($payroll->deductions, 2) }}</td>
            </tr>
            <tr>
                <th>Net Pay</th>
                <td><strong>ZMW {{ number_format($payroll->net_salary, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="section">
        @php($n = \App\Models\NapsaContribution::where('employee_id',$payroll->employee_id)->where('month',$payroll->month)->first())
        @if($n)
        <table>
            <thead>
                <tr><th colspan="2">NAPSA Contributions</th></tr>
            </thead>
            <tr>
                <th>Employee</th>
                <td>ZMW {{ number_format($n->employee_contrib, 2) }}</td>
            </tr>
            <tr>
                <th>Employer</th>
                <td>ZMW {{ number_format($n->employer_contrib, 2) }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>ZMW {{ number_format($n->total_contrib, 2) }}</td>
            </tr>
        </table>
        @endif
    </div>
</body>
</html>
