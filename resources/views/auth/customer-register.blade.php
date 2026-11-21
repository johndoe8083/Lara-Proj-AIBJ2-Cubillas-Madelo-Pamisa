@extends('layouts.app')
@section('title', 'Create Account')
@section('content')
<div class="auth-wrap"><form class="auth-card" method="POST" action="{{ route('customer.register.submit') }}">
    @csrf
    <p class="eyebrow">BECOME A MEMBER</p><h1>CREATE ACCOUNT</h1>
    @if($errors->any())<div class="alert"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <label>Full name<input type="text" name="name" value="{{ old('name') }}" required></label>
    <label>Email address<input type="email" name="email" value="{{ old('email') }}" required></label>
    <label>Password<input type="password" name="password" required></label>
    <label>Confirm password<input type="password" name="password_confirmation" required></label>
    <button class="button full" type="submit">CREATE ACCOUNT</button>
    <p class="muted">Already a member? <a href="{{ route('customer.login') }}">Sign in</a></p>
</form></div>
@endsection
