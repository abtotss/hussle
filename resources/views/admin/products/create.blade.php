@extends('admin.layout')

@section('admin-content')
  <h1>Add New Product</h1>

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50">{{ old('description') }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" value="{{ old('price') }}" required><br><br>

    <label>Category:</label><br>
    <select name="categories[]" multiple>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select><br><br>

    <label>Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save Product</button>
  </form>
@endsection
