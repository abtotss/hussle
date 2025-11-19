@extends('layouts.app')

@section('content')
<style>
    /* Basic styling for the admin layout */
    .admin-layout {
        display: flex;
        gap: 20px;
        min-height: 80vh;
    }
    .admin-sidebar {
        width: 250px;
        background: #fff;
        padding: 20px;
        border-right: 1px solid #eee;
        box-shadow: 2px 0 5px rgba(0,0,0,0.05);
    }
    .admin-main {
        flex: 1;
        padding: 20px;
    }
    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .nav-list li a {
        display: block;
        padding: 10px 15px;
        margin-bottom: 5px;
        text-decoration: none;
        color: #333;
        border-radius: 5px;
        transition: background-color 0.2s;
    }
    .nav-list li a:hover {
        background-color: #f0f0f0;
    }
    .nav-list li a.active {
        background-color: #4f46e5; /* Indigo 600 */
        color: #fff;
    }
    .nav-group-title {
        font-weight: bold;
        color: #6b7280; /* Gray 500 */
        padding: 10px 0;
        margin-top: 15px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }
</style>

<div class="admin-layout">
  <aside class="admin-sidebar">
    <h3 class="text-xl font-bold mb-4">Admin Panel</h3>

    <ul class="nav-list">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
    </ul>

    <div class="nav-group-title">Catalog Management</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a></li>
    </ul>

    <div class="nav-group-title">System & Users</div>
    <ul class="nav-list">
        {{-- New Link --}}
        <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a></li>
        {{-- New Link --}}
        <li><a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">Settings</a></li>
    </ul>
  </aside>

  <main class="admin-main">
    @if(session('success'))
      <div style="padding:10px;background:#ecfdf5;border:1px solid #c6f6d5;margin-bottom:10px; color:#065f46; border-radius:5px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div style="padding:10px;background:#fef2f2;border:1px solid #fecaca;margin-bottom:10px; color:#b91c1c; border-radius:5px;">{{ session('error') }}</div>
    @endif

    @yield('admin-content')
  </main>
</div>
@endsection