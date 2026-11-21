@extends('layouts.app')
@section('title', 'Book an Appointment')
@section('content')
<section class="booking-wrap">
    <div class="booking-heading">
        <p class="eyebrow">RESERVE YOUR CHAIR</p>
        <h1>BOOK AN <span>APPOINTMENT</span></h1>
        <p>Choose your service, barber, and preferred schedule. Your request will be saved to our booking database.</p>
    </div>
    <div class="booking-card">
        @if ($errors->any())
            <div class="alert" role="alert"><strong>Please check the form:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('customer.appointments.store') }}" class="booking-form">
            @csrf
            <div class="booking-customer">
                <div><span>BOOKING FOR</span><strong>{{ auth()->user()->name }}</strong></div>
                <div><span>ACCOUNT EMAIL</span><strong>{{ auth()->user()->email }}</strong></div>
            </div>
            <div class="booking-grid">
                <label>SELECT SERVICE
                    <select name="service_id" id="service_id" required>
                        <option value="">Choose a service</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" data-duration="{{ $service->duration_minutes }}" data-price="{{ number_format($service->price, 2, '.', '') }}" data-custom="{{ $service->is_custom_priced ? '1' : '0' }}" @selected(old('service_id') == $service->id)>{{ $service->name }} — {{ $service->is_custom_priced ? 'Price depends on haircut' : '₱' . number_format($service->price, 2) }} ({{ $service->duration_minutes }} min)</option>
                        @endforeach
                    </select>
                </label>
                <label>CHOOSE YOUR BARBER
                    <select name="barber_id" required>
                        <option value="">Select a barber</option>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" @selected(old('barber_id') == $barber->id)>{{ $barber->name }} — {{ $barber->specialty }}</option>
                        @endforeach
                    </select>
                </label>
                <label>APPOINTMENT DATE
                    <input type="date" name="appointment_date" min="{{ now()->toDateString() }}" value="{{ old('appointment_date') }}" required>
                </label>
                <label>PREFERRED TIME
                    <input type="time" name="start_time" value="{{ old('start_time') }}" required>
                    <small>Working hours: 9:00 AM–6:00 PM, subject to availability.</small>
                </label>
                <label class="booking-full">NOTES FOR YOUR BARBER <span class="optional">(OPTIONAL)</span>
                    <textarea name="customer_notes" id="customer_notes" rows="4" maxlength="1000" placeholder="Tell us your preferred haircut, style, or any special requests...">{{ old('customer_notes') }}</textarea>
                    <small id="customCutHint" hidden>For Custom Cut, please describe the haircut you want, your preferred length, and/or a reference photo description. The barber will confirm the final price before the appointment.</small>
                </label>
            </div>
            <div class="booking-summary" id="bookingSummary">Select a service to view its duration and price.</div>
            <div class="booking-actions">
                <a class="button button-outline" href="{{ route('home') }}">CANCEL</a>
                <button class="button" type="submit">SUBMIT APPOINTMENT REQUEST →</button>
            </div>
            <p class="booking-footnote">Your appointment will be marked as <strong>Pending</strong> until an administrator confirms it.</p>
        </form>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const service = document.getElementById('service_id');
    const summary = document.getElementById('bookingSummary');
    function updateSummary() {
        const option = service.options[service.selectedIndex];
        if (!option || !option.value) { summary.textContent = 'Select a service to view its duration and price.'; document.getElementById('customCutHint').hidden = true; return; }
        const isCustom = option.dataset.custom === '1';
        document.getElementById('customCutHint').hidden = !isCustom;
        document.getElementById('customer_notes').required = isCustom;
        summary.textContent = isCustom
            ? 'Estimated duration: ' + option.dataset.duration + ' minutes | Price depends on your requested haircut. The barber will provide a quote before confirmation.'
            : 'Estimated duration: ' + option.dataset.duration + ' minutes | Service price: ₱' + Number(option.dataset.price).toLocaleString('en-PH', {minimumFractionDigits: 2});
    }
    service.addEventListener('change', updateSummary);
    updateSummary();
});
</script>
@endsection
