<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function create(): View
    {
        return view('customer.appointments.create', [
            'services' => Service::query()->where('is_active', true)->orderBy('name')->get(),
            'barbers' => Barber::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'barber_id' => ['required', 'integer', 'exists:barbers,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'customer_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $service = Service::query()->where('is_active', true)->findOrFail($validated['service_id']);
        if ($service->is_custom_priced && blank($validated['customer_notes'] ?? null)) {
            throw ValidationException::withMessages(['customer_notes' => 'Please describe your custom haircut or add a reference/style request so the barber can prepare a quote.']);
        }
        $barber = Barber::query()->where('is_active', true)->findOrFail($validated['barber_id']);
        $start = Carbon::createFromFormat('H:i', $validated['start_time']);
        $end = $start->copy()->addMinutes((int) $service->duration_minutes);
        $date = Carbon::parse($validated['appointment_date']);

        if ($date->isToday() && $start->format('H:i') <= now()->format('H:i')) {
            throw ValidationException::withMessages(['start_time' => 'Please choose a time later than the current time.']);
        }

        $schedule = $barber->schedules()->where('day_of_week', $date->dayOfWeek)->first();
        if (!$schedule || $schedule->is_day_off) {
            throw ValidationException::withMessages(['appointment_date' => 'This barber is not available on the selected day.']);
        }

        if ($start->format('H:i:s') < $schedule->start_time || $end->format('H:i:s') > $schedule->end_time) {
            throw ValidationException::withMessages(['start_time' => 'Choose a time within the barber\'s working hours.']);
        }

        $appointment = DB::transaction(function () use ($validated, $service, $barber, $date, $start, $end, $request) {
            $overlap = Appointment::query()
                ->where('barber_id', $barber->id)
                ->whereDate('appointment_date', $date->toDateString())
                ->whereNotIn('status', ['cancelled', 'rejected'])
                ->where('start_time', '<', $end->format('H:i:s'))
                ->where('end_time', '>', $start->format('H:i:s'))
                ->lockForUpdate()
                ->exists();

            if ($overlap) {
                throw ValidationException::withMessages(['start_time' => 'That time is already booked. Please select another time.']);
            }

            return Appointment::create([
                'appointment_code' => 'BH-' . strtoupper(Str::random(8)),
                'user_id' => $request->user()->id,
                'barber_id' => $barber->id,
                'service_id' => $service->id,
                'appointment_date' => $date->toDateString(),
                'start_time' => $start->format('H:i:s'),
                'end_time' => $end->format('H:i:s'),
                'price' => $service->is_custom_priced ? 0 : $service->price,
                'price_is_quote' => (bool) $service->is_custom_priced,
                'status' => 'pending',
                'customer_notes' => $validated['customer_notes'] ?? null,
            ]);
        });

        return redirect()->route('customer.dashboard')->with('success', 'Your appointment request ' . $appointment->appointment_code . ' has been saved. It is pending confirmation.');
    }
}
