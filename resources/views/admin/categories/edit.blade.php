@extends('admin.layout')

@section('admin-content')
  <h1>Edit Category: {{ $category->name }}</h1>

  <form method="POST" action="{{ route('admin.categories.update', $category) }}">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" required><br><br>

    <button type="submit">Update</button>
  </form>
@endsection
