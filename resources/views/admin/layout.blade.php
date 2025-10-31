@extends('layouts.app')

@section('content')
<div style="display:flex; gap:20px;">
  <aside style="width:220px; background:#fff; padding:20px; border:1px solid #eee;">
    <h3>Admin</h3>
    <ul style="list-style:none; padding:0;">
      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route('admin.products.index') }}">Products</a></li>
      <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
      <li><a href="{{ route('admin.orders.index') }}">Orders</a> <!-- future --></li>
    </ul>
  </aside>

  <main style="flex:1;">
    @if(session('success'))
      <div style="padding:10px;background:#ecfdf5;border:1px solid #c6f6d5;margin-bottom:10px;">{{ session('success') }}</div>
    @endif

    @yield('admin-content')
  </main>
</div>
@endsection
