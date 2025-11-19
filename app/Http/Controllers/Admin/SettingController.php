<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show the mass-edit settings page.
     */
    public function index(): View
    {
        $settingsKeys = [
            'site_name',
            'site_email',
            'site_phone',
            'social_facebook',
            'social_twitter',
            'social_instagram',
            'products_per_page',
            'maintenance_mode',
        ];

        $stored = Setting::whereIn('key', $settingsKeys)->pluck('value', 'key')->toArray();

        $defaultSettings = [
            'site_name' => 'Hussle E-commerce',
            'site_email' => 'support@hussle.com',
            'site_phone' => '+1-555-1234',
            'social_facebook' => 'https://facebook.com/hussle',
            'social_twitter' => 'https://twitter.com/hussle',
            'social_instagram' => 'https://instagram.com/hussle',
            'products_per_page' => 12,
            'maintenance_mode' => 'off',
        ];

        $settings = array_merge($defaultSettings, $stored);

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the create form for a single setting.
     */
    public function create(): View
    {
        return view('admin.settings.create');
    }

    /**
     * Store a single newly created setting.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'key' => 'required|string|max:191|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|string|in:string,boolean,integer,json,array',
            'description' => 'nullable|string',
        ]);

        Setting::create($data);

        return redirect()->route('admin.settings.index')->with('success', 'Setting created.');
    }

    /**
     * Show edit form for a single setting.
     */
    public function edit(Setting $setting): View
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update a single setting (resource-style).
     */
    public function update(Request $request, Setting $setting): RedirectResponse
    {
        $data = $request->validate([
            'key' => 'required|string|max:191|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|string|in:string,boolean,integer,json,array',
            'description' => 'nullable|string',
        ]);

        if (($data['type'] ?? '') === 'boolean') {
            $data['value'] = filter_var($data['value'] ?? false, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated.');
    }

    /**
     * Bulk update settings from the mass-edit page.
     * Endpoint: PUT /admin/settings  named admin.settings.bulk-update
     */
    public function bulkUpdate(Request $request): RedirectResponse
    {
        $input = $request->except(['_token', '_method']);

        if (empty($input)) {
            return redirect()->route('admin.settings.index')->with('info', 'No settings provided.');
        }

        // Keys considered checkboxes/toggles in your form
        $checkboxKeys = ['maintenance_mode'];

        // Ensure unchecked checkboxes get an explicit off value
        foreach ($checkboxKeys as $ckey) {
            if (!array_key_exists($ckey, $input)) {
                $input[$ckey] = '0'; // or 'off' depending on how you interpret it
            }
        }

        foreach ($input as $key => $value) {
            // Normalize booleans for known checkbox keys
            if (in_array($key, $checkboxKeys, true)) {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $value, 'type' => 'string']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Delete a single setting.
     */
    public function destroy(Setting $setting): RedirectResponse
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted.');
    }
}
