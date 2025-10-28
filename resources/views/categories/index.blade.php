@extends('layouts.app')

@section('content')
  <h1>Categories</h1>
  <ul>
    @foreach($categories as $category)
      <li>
        <a href="{{ route('categories.show', $category->slug) }}">
          {{ $category->name }} ({{ $category->products_count }})
        </a>
      </li>
    @endforeach
  </ul>
@endsection
