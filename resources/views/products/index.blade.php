@extends('layouts.app')

@section('title','Products')

@section('content')
  <h1>Products</h1>

  @if($products->isEmpty())
    <p>No products found.</p>
  @else
    <ul>
      @foreach($products as $product)
        <li style="margin-bottom:12px">
          <a href="{{ route('products.show', $product->slug) }}"><strong>{{ $product->name }}</strong></a>
          — ${{ number_format($product->price, 2) }}
          <div style="font-size:0.9em;color:#666">
            Categories:
            @foreach($product->categories as $cat)
              <span>{{ $cat->name }}</span>@if(!$loop->last), @endif
            @endforeach
          </div>
        </li>
      @endforeach
    </ul>

    {{ $products->links() }}
  @endif
@endsection
