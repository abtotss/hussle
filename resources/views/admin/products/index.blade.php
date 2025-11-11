@extends('admin.layout')

@section('admin-content')
  <h1>Products</h1>

  <a href="{{ route('admin.products.create') }}">+ Add New Product</a>

  <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:15px;">
    <thead>
      <tr style="background:#f9fafb;">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>${{ number_format($product->price, 2) }}</td>
          <td>
            @foreach ($product->categories as $category)
              <span>{{ $category->name }}</span>@if(!$loop->last), @endif
            @endforeach
          </td>
          <td>
            <a href="{{ route('admin.products.edit', $product) }}">Edit</a> |
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5">No products found.</td></tr>
      @endforelse
    </tbody>
  </table>
@endsection
