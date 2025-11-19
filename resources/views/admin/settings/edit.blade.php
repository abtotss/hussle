@extends('admin.layout')

@section('admin-content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Setting</h1>
            <p class="text-gray-600 mt-1">Modify an existing setting value.</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.settings.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Back to settings</a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Key</label>
                    <input
                        type="text"
                        name="key"
                        value="{{ old('key', $setting->key) }}"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                        required
                    />
                    @error('key') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1">The key is how your code references this setting. Changing it may break references.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Value</label>
                    <textarea
                        name="value"
                        rows="4"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                    >{{ old('value', $setting->value) }}</textarea>
                    @error('value') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    @if($setting->type === 'boolean')
                        <p class="text-xs text-gray-500 mt-1">This key is a boolean. Use <code>1</code> or <code>0</code>, or use the bulk-edit page to toggle.</p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring">
                        <option value="string" {{ old('type', $setting->type) == 'string' ? 'selected' : '' }}>string</option>
                        <option value="boolean" {{ old('type', $setting->type) == 'boolean' ? 'selected' : '' }}>boolean</option>
                        <option value="integer" {{ old('type', $setting->type) == 'integer' ? 'selected' : '' }}>integer</option>
                        <option value="json" {{ old('type', $setting->type) == 'json' ? 'selected' : '' }}>json</option>
                        <option value="array" {{ old('type', $setting->type) == 'array' ? 'selected' : '' }}>array (comma-separated)</option>
                    </select>
                    @error('type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description (optional)</label>
                    <textarea
                        name="description"
                        rows="2"
                        class="mt-1 block w-full border rounded-md px-3 py-2 focus:outline-none focus:ring"
                    >{{ old('description', $setting->description) }}</textarea>
                    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex items-center space-x-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md shadow-sm hover:bg-yellow-700">Save changes</button>

                <a href="{{ route('admin.settings.index') }}" class="text-sm text-gray-600">Cancel</a>

                <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="POST" class="ml-auto" onsubmit="return confirm('Delete this setting? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-50 text-red-600 rounded-md border border-red-100 hover:bg-red-100">Delete</button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
