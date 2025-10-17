<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-xl font-semibold text-sanlam-secondary mb-4">My Payslips</h1>
        <div class="bg-white shadow-card rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-sanlam-accent/40">
                    <tr>
                        <th class="px-3 py-2 text-left">Month</th>
                        <th class="px-3 py-2 text-left">Net Pay</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payslips as $p)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $p->payroll->month }}</td>
                            <td class="px-3 py-2">ZMW {{ number_format($p->payroll->net_salary, 2) }}</td>
                            <td class="px-3 py-2 text-right">
                                <a href="{{ Storage::disk('public')->url($p->pdf_path) }}" class="text-blue-600 hover:underline" target="_blank">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-3 py-4" colspan="3">No payslips yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
