@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <h1>{{ $welcome }}</h1>

  <p>We are an Award Winning Online Digital Marketplace</p>

  <h2>Features</h2>
  <ul>
    @foreach ($features as $feature)
      <li>{{ $feature }}</li>
    @endforeach
  </ul>

  {{-- Example: show how many features --}}
  <p><strong>Total features:</strong> {{ count($features) }}</p>
@endsection
