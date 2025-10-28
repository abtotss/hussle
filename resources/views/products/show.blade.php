@extends('layouts.app')

@section('title', $product->name)

@section('content')
  <h1>{{ $product->name }}</h1>
  <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
  <p><strong>Stock:</strong> {{ $product->stock }}</p>

  <div>
    <strong>Categories:</strong>
    @foreach($product->categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}">{{ $cat->name }}</a>@if(!$loop->last), @endif
    @endforeach
  </div>

  <hr>

  <p>{{ $product->description }}</p>
@endsection
