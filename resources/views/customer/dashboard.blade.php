@extends('layouts.app')
@section('title', 'My Account')
@section('content')
<section class="dashboard">
    <div class="dash-top"><div><p class="eyebrow">CUSTOMER AREA</p><h1>MY APPOINTMENTS</h1><p class="muted">Welcome, {{ auth()->user()->name }}.</p></div>
    <form method="POST" action="{{ route('customer.logout') }}">@csrf<button class="button button-outline">LOG OUT</button></form></div>
    @if (session('success'))
        <div class="alert" style="background:#263b2b;color:#d9f5dc" role="status">{{ session('success') }}</div>
    @endif
    <div style="margin:0 0 20px"><a class="button" href="{{ route('customer.appointments.create') }}">BOOK ANOTHER APPOINTMENT →</a></div>
    <div class="panel">
        @forelse($appointments as $appointment)
            <div class="appointment-row">
                <strong>{{ $appointment->appointment_code }}</strong>
                <span>{{ $appointment->service->name }}</span>
                <span>{{ $appointment->barber->name }}</span>
                <span>{{ $appointment->price_is_quote ? "Price: To be quoted" : "₱" . number_format((float) $appointment->price, 2) }}</span>
                <span>{{ $appointment->appointment_date->format('M d, Y') }}</span>
                <span class="status">{{ ucfirst($appointment->status) }}</span>
            </div>
        @empty
            <p class="muted">You have no appointments yet. Select “Book Another Appointment” to reserve your first visit.</p>
        @endforelse
    </div>
</section>
@endsection
