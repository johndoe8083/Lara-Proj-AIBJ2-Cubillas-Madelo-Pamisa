@extends('layouts.app')
@section('title', 'Modern Barbershop')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
@push('scripts')
<script defer src="{{ asset('js/home.js') }}"></script>
@endpush
@section('content')
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">PREMIUM BARBERSHOP</p>
        <h1>LOOK SHARP.<br><span>FEEL CONFIDENT.</span></h1>
        <p class="lead">Book online in minutes and walk out sharp, with professional cuts and precise grooming.</p>
        <div class="hero-actions">
            <a class="button" href="{{ auth()->check() && auth()->user()->role === 'customer' ? route('customer.appointments.create') : route('customer.login') }}">BOOK AN APPOINTMENT →</a>
            <a class="button button-outline" href="#services">VIEW SERVICES</a>
        </div>
    </div>
    <div class="hero-art"><img class="hero-interior" src="{{ asset('images/barbershop-interior.jpg') }}" alt="Warm, luxurious BarberHub barbershop interior"></div>
</section>

<section class="section" id="services">
    <div class="section-heading section-heading-row">
        <div><p class="eyebrow">OUR SERVICES</p><h2>Our Haircut &amp; Grooming Services</h2></div>
    </div>
    <div class="cards service-grid">
        @forelse($services as $service)
            <article class="service-card">
                @if($service->image)
                    <img class="service-image" src="{{ asset($service->image) }}" alt="{{ $service->name }}">
                @endif
                <div class="service-content">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->description }}</p>
                    <div class="service-meta"><span>◷ {{ $service->duration_minutes }} min</span><strong>{{ $service->is_custom_priced ? 'Price depends on haircut' : '₱' . number_format($service->price, 0) }}</strong></div>
                </div>
            </article>
        @empty
            <p class="muted">Services will appear here after database setup and seeding.</p>
        @endforelse
    </div>
</section>

<section class="section barber-section" id="barbers">
    <div class="section-heading">
        <p class="eyebrow">MEET THE TEAM</p><h2>Our Barbers</h2>
    </div>
    <div class="cards barber-grid">
        @forelse($barbers as $barber)
            <article class="barber-card">
                @if($barber->photo)
                    <img class="barber-image" src="{{ asset($barber->photo) }}" alt="Portrait of {{ $barber->name }}">
                @else
                    <div class="barber-placeholder">{{ strtoupper(substr($barber->name, 0, 1)) }}</div>
                @endif
                <div class="barber-content">
                    <h3>{{ $barber->name }}</h3>
                    <p class="barber-role">{{ $barber->specialty }}</p>
                    <p>{{ $barber->bio }}</p>
                </div>
            </article>
        @empty
            <p class="muted">Our barber profiles will appear here after database setup and seeding.</p>
        @endforelse
    </div>
</section>
<section class="barber-band">
    <p class="eyebrow">YOUR NEXT GREAT CUT STARTS HERE</p><h2>READY FOR A FRESH LOOK?</h2>
    <p>Choose your service and reserve your visit with BarberHub.</p>
    <a class="button" href="{{ auth()->check() && auth()->user()->role === 'customer' ? route('customer.appointments.create') : route('customer.login') }}">BOOK YOUR VISIT</a>
</section>
@endsection
