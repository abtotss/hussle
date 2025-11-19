@extends('admin.layout')

@section('admin-content')
<div class="space-y-6">
    <!-- Page Header + Filters -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
            <p class="text-sm text-gray-500 mt-1">Manage users, roles and registrations.</p>
        </div>

        <!-- Filter / Search Form -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center space-x-3">
            <label for="search" class="sr-only">Search users</label>
            <input
                id="search"
                name="search"
                type="search"
                value="{{ request('search') }}"
                placeholder="Search by name or email..."
                class="block w-64 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                aria-label="Search users"
            >

            <label for="role" class="sr-only">Filter by role</label>
            <select id="role" name="role" class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All roles</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Apply</button>

            @if(request()->has('search') || request()->has('role') && request('role') !== '')
                <a href="{{ route('admin.users.index') }}" class="text-sm px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Clear</a>
            @endif
        </form>
    </div>

    <!-- Success/Error Messages -->
    <div>
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded" role="status">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded" role="status">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($users as $user)
                            <tr data-href="{{ route('admin.users.edit', $user) }}" class="hover:bg-gray-50 cursor-pointer">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <!-- Name links to edit (accessible) -->
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-block text-indigo-600 hover:underline" title="Edit {{ $user->name }}">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $isAdmin = $user->role === 'admin';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $isAdmin ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" title="{{ $user->created_at->toDayDateTimeString() }}">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                    @if(Auth::user()->id !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination (preserve search/role params) -->
            <div class="mt-4">
                {{ $users->appends(request()->only(['search', 'role']))->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Small script to make rows clickable but keep links/forms clickable -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('tr[data-href]').forEach(function (row) {
        row.addEventListener('click', function (e) {
            // If click originated from a link/button/form element, don't navigate.
            if (e.target.closest('a') || e.target.closest('button') || e.target.closest('form')) return;
            window.location = this.getAttribute('data-href');
        });
        // keyboard accessible
        row.setAttribute('tabindex', '0');
        row.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                if (!e.target.closest('a') && !e.target.closest('button') && !e.target.closest('form')) {
                    window.location = this.getAttribute('data-href');
                }
            }
        });
    });
});
</script>
@endpush

@endsection
