@extends('layouts.app')
@section('title', 'Contact Us')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush
@push('scripts')
<script defer src="{{ asset('js/contact-validation.js') }}"></script>
@endpush
@section('content')
<section class="inner-hero contact-hero">
    <p class="eyebrow">WE'D LOVE TO HEAR FROM YOU</p>
    <h1>LET'S <span>CONNECT.</span></h1>
    <p>Have a question, request, or feedback? Send our team a message using the form below.</p>
</section>
<section class="contact-section">
    <div class="contact-details">
        <p class="eyebrow">CONTACT DETAILS</p><h2>Get in touch.</h2>
        <p class="muted">For appointments, service inquiries, or feedback, get in touch with the BarberHub team. We look forward to welcoming you.</p>
        <div class="contact-detail"><span>EMAIL</span><strong><a href="mailto:barberhub@gmail.com">barberhub@gmail.com</a></strong></div>
        <div class="contact-detail"><span>PHONE</span><strong><a href="tel:+639107832457">+63 910 7832 4573</a></strong></div>
        <div class="contact-detail"><span>LOCATION</span><strong>BarberHub, G&amp;C Building, Butuan City, 8600 Agusan del Norte</strong></div>
        <div class="contact-detail"><span>BUSINESS HOURS</span><strong>Monday – Saturday · 9:00 AM – 7:00 PM</strong></div>
    </div>
    <div class="contact-form-card">
        <p class="eyebrow">SEND A MESSAGE</p><h2>Contact form</h2>
        @if(session('success'))<div class="form-success" role="status">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert"><strong>Please correct the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form id="contactForm" class="contact-form" method="POST" action="{{ route('contact.store') }}" novalidate>
            @csrf
            <label for="contactName">Name</label><input id="contactName" name="name" value="{{ old('name') }}" autocomplete="name" required maxlength="120"><small class="field-error" data-error-for="name"></small>
            <label for="contactEmail">Email</label><input id="contactEmail" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required maxlength="190"><small class="field-error" data-error-for="email"></small>
            <label for="contactSubject">Subject</label><input id="contactSubject" name="subject" value="{{ old('subject') }}" required maxlength="180"><small class="field-error" data-error-for="subject"></small>
            <label for="contactMessage">Message</label><textarea id="contactMessage" name="message" rows="6" required minlength="10" maxlength="5000">{{ old('message') }}</textarea><small class="field-error" data-error-for="message"></small>
            <button class="button contact-submit" type="submit">SEND MESSAGE →</button>
            <p id="contactClientSuccess" class="client-success" role="status" aria-live="polite" hidden></p>
            <p class="form-note">Your message will be securely submitted and saved for the BarberHub team.</p>
        </form>
    </div>
</section>
@endsection
