<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h1 class="text-xl font-semibold text-sanlam-secondary mb-4">Add Employee</h1>
        <form method="post" action="{{ route('employees.store') }}" class="space-y-4 bg-white p-6 rounded shadow-card">
            @csrf
            <div>
                <label class="block text-sm">Name</label>
                <input name="name" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Email</label>
                <input type="email" name="email" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">NAPSA Number</label>
                <input name="napsa_number" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Position</label>
                <input name="position" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div>
                <label class="block text-sm">Basic Salary</label>
                <input type="number" step="0.01" name="basic_salary" class="mt-1 w-full rounded border-silt" required />
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-sanlam-primary text-white rounded hover:bg-blue-700">Save</button>
                <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-gray-100 text-sanlam-secondary rounded">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
