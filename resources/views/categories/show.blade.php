@extends('layouts.app')

@section('content')
  <h1>{{ $category->name }}</h1>

  @if($category->description)
    <p>{{ $category->description }}</p>
  @endif

  <h2>Products</h2>

  @if($products->isEmpty())
    <p>No products yet.</p>
  @else
    <ul>
      @foreach($products as $product)
        <li>
          <a href="#">{{ $product->name }}</a>
          — {{ \Illuminate\Support\Str::limit($product->description, 80) }}
        </li>
      @endforeach
    </ul>

    {{ $products->links() }} {{-- Laravel pagination links --}}
  @endif
@endsection
