<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-semibold text-sanlam-secondary">Employees</h1>
            <a href="{{ route('employees.create') }}" class="px-3 py-2 bg-sanlam-primary text-white rounded hover:bg-blue-700">Add Employee</a>
        </div>
        <div class="bg-white shadow-card rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-sanlam-accent/40">
                    <tr>
                        <th class="px-3 py-2 text-left">Name</th>
                        <th class="px-3 py-2 text-left">Email</th>
                        <th class="px-3 py-2 text-left">Position</th>
                        <th class="px-3 py-2 text-left">Basic Salary</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $e)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $e->name }}</td>
                            <td class="px-3 py-2">{{ $e->email }}</td>
                            <td class="px-3 py-2">{{ $e->position }}</td>
                            <td class="px-3 py-2">ZMW {{ number_format($e->basic_salary, 2) }}</td>
                            <td class="px-3 py-2 text-right">
                                <a href="{{ route('employees.edit', $e) }}" class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $employees->links() }}</div>
    </div>
</x-app-layout>
