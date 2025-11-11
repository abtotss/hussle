@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div style="display:flex;justify-content:center;align-items:center;min-height:80vh;">
  <div style="width:420px;background:#fff;padding:28px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.06);">
    <h2 style="text-align:center;margin-bottom:18px;">Create Account</h2>

    @if(session('success'))
      <div style="padding:10px;background:#ecfdf5;border:1px solid #c6f6d5;margin-bottom:12px;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div style="margin-bottom:12px;">
        <label>Name</label><br>
        <input name="name" value="{{ old('name') }}" required autofocus style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;">
        @error('name') <div style="color:#b91c1c;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div style="margin-bottom:12px;">
        <label>Email</label><br>
        <input name="email" value="{{ old('email') }}" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;">
        @error('email') <div style="color:#b91c1c;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div style="margin-bottom:12px;">
        <label>Password</label><br>
        <input type="password" name="password" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;">
        @error('password') <div style="color:#b91c1c;font-size:13px;">{{ $message }}</div> @enderror
      </div>

      <div style="margin-bottom:12px;">
        <label>Confirm Password</label><br>
        <input type="password" name="password_confirmation" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;">
      </div>

      {{-- Role selector only visible to admins --}}
      @if(auth()->check() && auth()->user()->role === 'admin')
        <div style="margin-bottom:12px;">
          <label>Role</label><br>
          <select name="role" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;">
            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role') <div style="color:#b91c1c;font-size:13px;">{{ $message }}</div> @enderror
        </div>
      @endif

      <button type="submit" style="width:100%;padding:10px;background:#2563eb;color:white;border:none;border-radius:6px;cursor:pointer;">
        Register
      </button>
    </form>

    <p style="text-align:center;margin-top:14px;font-size:14px;">
      Already registered?
      <a href="{{ route('login') }}">Log in</a>
    </p>
  </div>
</div>
@endsection
