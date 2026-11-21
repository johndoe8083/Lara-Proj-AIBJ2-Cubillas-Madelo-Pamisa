@extends('layouts.app')
@section('title', 'About Us')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush
@push('scripts')
<script defer src="{{ asset('js/about.js') }}"></script>
@endpush
@section('content')
<section class="inner-hero">
    <p class="eyebrow">THE BARBERHUB STORY</p>
    <h1>MORE THAN A CUT.<br><span>A BETTER EXPERIENCE.</span></h1>
    <p>Classic barbering values, modern techniques, and a welcoming place where every client can look sharp and feel confident.</p>
</section>
<section class="about-section">
    <div class="about-story">
        <div>
            <p class="eyebrow">WHO WE ARE</p>
            <h2>Craftsmanship in every detail.</h2>
        </div>
        <div class="about-copy">
            <p>BarberHub is a barbershop concept built around quality grooming, personal service, and attention to detail. From timeless cuts to modern fades, our goal is to make every visit comfortable, consistent, and worth coming back for.</p>
            <div id="aboutMore" class="read-more-content" hidden>
                <p>We believe a great barbershop is more than a place to get a haircut. It is a space to relax, connect, and leave with renewed confidence. Our team listens to each client's preferences and recommends a style that fits their look and lifestyle.</p>
                <p>This website is an academic project demonstration. Shop address, operating hours, and business contact details can be updated to match the actual business.</p>
            </div>
            <button class="button button-outline read-more-button" type="button" id="readMoreToggle" aria-expanded="false" aria-controls="aboutMore">READ MORE +</button>
        </div>
    </div>
</section>
<section class="about-section about-values">
    <div class="section-heading"><p class="eyebrow">WHAT GUIDES US</p><h2>MISSION, VISION &amp; VALUES</h2></div>
    <div class="cards values-grid">
        <article class="value-card"><span>01</span><h3>Mission</h3><p>To provide reliable, high-quality grooming services through skilled barbering, friendly service, and a clean, welcoming environment.</p></article>
        <article class="value-card"><span>02</span><h3>Vision</h3><p>To become a trusted neighborhood barbershop known for craftsmanship, customer care, and helping every client feel confident.</p></article>
        <article class="value-card"><span>03</span><h3>Values</h3><p>Quality, respect, consistency, creativity, and customer satisfaction guide every appointment and every cut.</p></article>
    </div>
</section>
<section class="about-section team-section">
    <div class="section-heading"><p class="eyebrow">THE PEOPLE BEHIND THE PROJECT</p><h2>PROJECT TEAM</h2><p class="muted">The members responsible for planning and developing the BarberHub website.</p></div>
    <div class="cards team-grid">
        <article class="team-card"><div class="team-avatar">RC</div><p class="team-role">MEMBER 1 · PROJECT LEADER</p><h3>Rieljan Obatay Cubillas</h3><p>Project coordination and assigned website development tasks.</p></article>
        <article class="team-card"><div class="team-avatar">AM</div><p class="team-role">MEMBER 2 · ABOUT PAGE</p><h3>Andre Koskie Madelo</h3><p>Business background, mission and vision, team section, and Read More interaction.</p></article>
        <article class="team-card"><div class="team-avatar">KP</div><p class="team-role">MEMBER 3 · CONTACT PAGE</p><h3>Kenrussell Pamisa</h3><p>Contact information, message form, and client-side form validation.</p></article>
    </div>
</section>
@endsection
