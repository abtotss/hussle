@extends('admin.layout')

@section('admin-content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create Setting</h1>
            <p class="text-gray-600 mt-1">Add a new key/value setting for the application.</p>
        </div>

        <a href="{{ route('admin.settings.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Back to settings</a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.settings.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Key</label>
                    <input
                        type="text"
                        name="key"
                        value="{{ old('key') }}"
                        placeholder="e.g. site_name"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                        required
                    />
                    @error('key') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1">Unique key used to reference this setting in code.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Value</label>
                    <textarea
                        name="value"
                        rows="4"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                        placeholder="Value for the key (string, JSON, comma-separated list, etc.)"
                    >{{ old('value') }}</textarea>
                    @error('value') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring">
                        <option value="string" {{ old('type') == 'string' ? 'selected' : '' }}>string</option>
                        <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>boolean</option>
                        <option value="integer" {{ old('type') == 'integer' ? 'selected' : '' }}>integer</option>
                        <option value="json" {{ old('type') == 'json' ? 'selected' : '' }}>json</option>
                        <option value="array" {{ old('type') == 'array' ? 'selected' : '' }}>array (comma-separated)</option>
                    </select>
                    @error('type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
                    <textarea
                        name="description"
                        rows="2"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                        placeholder="Short description for admins"
                    >{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex items-center space-x-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md shadow-sm hover:bg-yellow-700">Create Setting</button>
                <a href="{{ route('admin.settings.index') }}" class="text-sm text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
