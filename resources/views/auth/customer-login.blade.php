@extends('layouts.app')
@section('title', 'Customer Login')
@section('content')
<div class="auth-wrap"><form class="auth-card" method="POST" action="{{ route('customer.login.submit') }}">
    @csrf
    <p class="eyebrow">WELCOME BACK</p><h1>CUSTOMER SIGN IN</h1>
    @if($errors->any())<div class="alert">{{ $errors->first() }}</div>@endif
    <label>Email address<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
    <label>Password<input type="password" name="password" required></label>
    <label class="check"><input type="checkbox" name="remember" value="1"> Remember me</label>
    <button class="button full" type="submit">SIGN IN</button>
    <p class="muted">New to BarberHub? <a href="{{ route('customer.register') }}">Create an account</a></p>
</form></div>
@endsection
