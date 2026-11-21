@extends('layouts.app')
@section('title', 'Administrator Login')
@section('content')
<div class="auth-wrap"><form class="auth-card" method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <p class="eyebrow">RESTRICTED ACCESS</p><h1>ADMIN PORTAL</h1>
    <p class="muted">Sign in with your administrator account.</p>
    @if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
    <label>Email address<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
    <label>Password<input type="password" name="password" required></label>
    <label class="check"><input type="checkbox" name="remember" value="1"> Remember me</label>
    <button class="button full" type="submit">ADMIN SIGN IN</button>
    <a class="text-link" href="{{ route('home') }}">← Back to website</a>
</form></div>
@endsection
