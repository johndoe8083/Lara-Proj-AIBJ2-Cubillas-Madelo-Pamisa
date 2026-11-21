<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Barber;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentsCount = Appointment::count();
        $confirmedCount = Appointment::where('status', 'confirmed')->count();
        $pendingCount = Appointment::where('status', 'pending')->count();
        $cancelledCount = Appointment::where('status', 'cancelled')->count();

        $monthlyBookings = collect(range(5, 0))->map(function (int $monthsAgo) {
            $month = now()->startOfMonth()->subMonths($monthsAgo);

            return [
                'label' => $month->format('M'),
                'count' => Appointment::whereBetween('appointment_date', [
                    $month->copy()->startOfMonth()->toDateString(),
                    $month->copy()->endOfMonth()->toDateString(),
                ])->count(),
            ];
        });

        $maxMonthlyBookings = max(1, (int) $monthlyBookings->max('count'));

        $appointments = Appointment::with(['customer', 'barber', 'service'])
            ->orderByDesc('appointment_date')
            ->orderByDesc('start_time')
            ->take(8)
            ->get();

        $topServices = Service::withCount('appointments')
            ->orderByDesc('appointments_count')
            ->orderBy('name')
            ->take(4)
            ->get();

        return view('admin.dashboard', [
            'appointmentsCount' => $appointmentsCount,
            'confirmedCount' => $confirmedCount,
            'pendingCount' => $pendingCount,
            'cancelledCount' => $cancelledCount,
            'customersCount' => User::where('role', 'customer')->count(),
            'barbersCount' => Barber::where('is_active', true)->count(),
            'servicesCount' => Service::where('is_active', true)->count(),
            'todayAppointmentsCount' => Appointment::whereDate('appointment_date', today())->count(),
            'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
            'monthlyBookings' => $monthlyBookings,
            'maxMonthlyBookings' => $maxMonthlyBookings,
            'appointments' => $appointments,
            'topServices' => $topServices,
        ]);
    }
}
