@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="display:flex;justify-content:center;align-items:center;min-height:80vh;">
  <div style="width:400px;background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="text-align:center;margin-bottom:20px;">Sign In</h2>

    @if(session('status'))
      <div style="background:#ecfdf5;padding:10px;margin-bottom:10px;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div style="margin-bottom:15px;">
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
          style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">
        @error('email')
          <span style="color:red;font-size:13px;">{{ $message }}</span>
        @enderror
      </div>

      <div style="margin-bottom:15px;">
        <label>Password</label><br>
        <input type="password" name="password" required
          style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">
        @error('password')
          <span style="color:red;font-size:13px;">{{ $message }}</span>
        @enderror
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
        <label><input type="checkbox" name="remember"> Remember me</label>
        <a href="{{ route('password.request') }}" style="font-size:13px;">Forgot password?</a>
      </div>

      <button type="submit"
        style="width:100%;padding:10px;background:#2563eb;color:white;border:none;border-radius:5px;cursor:pointer;">
        Log In
      </button>
    </form>

    <p style="text-align:center;margin-top:15px;">Don't have an account?
      <a href="{{ route('register') }}">Register</a>
    </p>
  </div>
</div>
@endsection

