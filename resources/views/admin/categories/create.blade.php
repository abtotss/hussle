@extends('admin.layout')

@section('admin-content')
  <h1>Add Category</h1>

  <form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <button type="submit">Save</button>
  </form>
@endsection
