@extends('admin.layout')

@section('admin-content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Site Settings</h1>
            <p class="mt-1 text-sm text-gray-600">Edit common site settings quickly. Use the preview below to confirm saved values.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.settings.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-md bg-yellow-600 text-white text-sm font-medium shadow hover:bg-yellow-700 focus:outline-none focus:ring">
                + Add Setting
            </a>
        </div>
    </div>

    <!-- Flash messages -->
    <div x-data="{ show: true }" x-show="show" x-cloak>
        @if(session('success'))
            <div class="relative bg-green-50 border border-green-100 text-green-800 px-4 py-3 rounded flex items-start justify-between">
                <div>
                    <strong class="font-medium">Success:</strong>
                    <div class="text-sm mt-1">{{ session('success') }}</div>
                </div>
                <button type="button" @click="show = false" class="ml-4 text-green-700 hover:text-green-900">✕</button>
            </div>
        @endif

        @if(session('info'))
            <div class="relative bg-blue-50 border border-blue-100 text-blue-800 px-4 py-3 rounded flex items-start justify-between mt-2">
                <div>
                    <strong class="font-medium">Info:</strong>
                    <div class="text-sm mt-1">{{ session('info') }}</div>
                </div>
                <button type="button" @click="show = false" class="ml-4 text-blue-700 hover:text-blue-900">✕</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="relative bg-red-50 border border-red-100 text-red-800 px-4 py-3 rounded flex items-start justify-between mt-2">
                <div>
                    <strong class="font-medium">Please fix the following:</strong>
                    <ul class="mt-1 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" @click="show = false" class="ml-4 text-red-700 hover:text-red-900">✕</button>
            </div>
        @endif
    </div>

    <!-- Form card -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="p-6">
            <form action="{{ route('admin.settings.bulk-update') }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Site name -->
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700">Site name</label>
                        <input id="site_name" name="site_name" type="text"
                               value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                               required
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                        <p class="mt-1 text-xs text-gray-500">The display name used in the header and title tag.</p>
                    </div>

                    <!-- Contact email -->
                    <div>
                        <label for="site_email" class="block text-sm font-medium text-gray-700">Contact email</label>
                        <input id="site_email" name="site_email" type="email"
                               value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                        <p class="mt-1 text-xs text-gray-500">Email used for customer contact and outgoing notifications.</p>
                    </div>

                    <!-- Contact phone -->
                    <div>
                        <label for="site_phone" class="block text-sm font-medium text-gray-700">Contact phone</label>
                        <input id="site_phone" name="site_phone" type="tel"
                               value="{{ old('site_phone', $settings['site_phone'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                        <p class="mt-1 text-xs text-gray-500">Optional — shown on contact pages.</p>
                    </div>

                    <!-- Products per page -->
                    <div>
                        <label for="products_per_page" class="block text-sm font-medium text-gray-700">Products per page</label>
                        <input id="products_per_page" name="products_per_page" type="number" min="1"
                               value="{{ old('products_per_page', $settings['products_per_page'] ?? 12) }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                        <p class="mt-1 text-xs text-gray-500">Controls pagination size on product listing pages.</p>
                    </div>

                    <!-- Facebook -->
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                        <input id="social_facebook" name="social_facebook" type="url"
                               placeholder="https://facebook.com/yourpage"
                               value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-gray-700">Twitter URL</label>
                        <input id="social_twitter" name="social_twitter" type="url"
                               placeholder="https://twitter.com/yourhandle"
                               value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                        <input id="social_instagram" name="social_instagram" type="url"
                               placeholder="https://instagram.com/yourhandle"
                               value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-200" />
                    </div>

                    <!-- Maintenance mode -->
                    <div class="md:col-span-2 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <!-- Hidden field ensures a value when checkbox is unchecked -->
                            <input type="hidden" name="maintenance_mode" value="0">

                            <label for="maintenance_mode" class="flex items-center cursor-pointer select-none">
                                <input id="maintenance_mode" name="maintenance_mode" type="checkbox" value="1"
                                       {{ old('maintenance_mode', (string)($settings['maintenance_mode'] ?? '0')) === '1' ? 'checked' : '' }}
                                       class="h-4 w-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500" />
                                <span class="ml-2 text-sm text-gray-700">Put site into maintenance mode</span>
                            </label>
                        </div>

                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md shadow hover:bg-yellow-700 focus:outline-none">
                                Save settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview card -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-medium text-gray-900">Current values (preview)</h2>
            <p class="text-sm text-gray-500">Last saved values from DB + defaults</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($settings as $k => $v)
                <div class="p-4 border border-gray-100 rounded">
                    <div class="text-xs font-semibold text-gray-500">{{ $k }}</div>
                    <div class="mt-2 text-sm text-gray-800 break-words">
                        @if($k === 'maintenance_mode')
                            @if((string)$v === '1' || (string)$v === 'on')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Enabled</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Disabled</span>
                            @endif
                        @else
                            {{ is_array($v) ? json_encode($v) : (string) $v }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Minimal AlpineJS shim for flash dismiss (optional) -->
<script>
    // If Alpine.js is not loaded in your layout, the x-data/x-show attributes will be ignored gracefully.
    // This small script is just to ensure the "x-cloak" attribute is removed if present.
    document.querySelectorAll('[x-cloak]').forEach(el => el.style.display = '');
</script>
@endsection
