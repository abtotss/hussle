@extends('admin.layout')

@section('admin-content')
  <h2>Categories</h2>
  <a href="{{ route('admin.categories.create') }}">Create Category</a>

  <table>
    <thead><tr><th>Name</th><th>Slug</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
          <td>{{ $category->slug }}</td>
          <td>
            <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('Delete?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $categories->links() }}
@endsection
