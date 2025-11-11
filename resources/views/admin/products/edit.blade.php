@extends('admin.layout')

@section('admin-content')
  <h1>Edit Product: {{ $product->name }}</h1>

  <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50">{{ old('description', $product->description) }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required><br><br>

    <label>Category:</label><br>
    <select name="categories[]" multiple>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}" @if(in_array($category->id, $product->categories->pluck('id')->toArray())) selected @endif>
          {{ $category->name }}
        </option>
      @endforeach
    </select><br><br>

    <label>Image:</label><br>
    @if($product->image)
      <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" width="100"><br>
    @endif
    <input type="file" name="image"><br><br>

    <button type="submit">Update Product</button>
  </form>
@endsection
