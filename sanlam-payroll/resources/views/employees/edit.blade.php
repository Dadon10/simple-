<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h1 class="text-xl font-semibold text-sanlam-secondary mb-4">Edit Employee</h1>
        <form method="post" action="{{ route('employees.update', $employee) }}" class="space-y-4 bg-white p-6 rounded shadow-card">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm">Name</label>
                <input name="name" value="{{ old('name', $employee->name) }}" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">NAPSA Number</label>
                <input name="napsa_number" value="{{ old('napsa_number', $employee->napsa_number) }}" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Position</label>
                <input name="position" value="{{ old('position', $employee->position) }}" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Basic Salary</label>
                <input type="number" step="0.01" name="basic_salary" value="{{ old('basic_salary', $employee->basic_salary) }}" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-sanlam-primary text-white rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-100 text-sanlam-secondary rounded">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
