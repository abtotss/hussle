@extends('layouts.app')

@section('title', 'About')

@section('content')
  <h1>{{ $intro }}</h1>

  <p>We are an Award Winning Online Digital Marketplace</p>

  <h2>Features</h2>
  <ul>
    @foreach ($services as $services)
      <li>{{ $services }}</li>
    @endforeach
  </ul>

  {{-- Example: show how many features --}}
 <p><strong>Total Services:</strong> {{ $servicesCount }}</p>
@endsection
