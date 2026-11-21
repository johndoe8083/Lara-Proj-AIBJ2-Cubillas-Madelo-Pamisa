@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="admin-shell">
    <aside class="admin-sidebar" aria-label="Admin navigation">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand" aria-label="BarberHub admin home">
            <span class="brand-mark">B<span>H</span></span>
        </a>
        <div class="sidebar-caption">WORKSPACE</div>
        <nav class="admin-nav">
            <a class="admin-nav-link is-active" href="#overview" title="Overview" aria-label="Overview">
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                <span>Overview</span>
            </a>
            <a class="admin-nav-link" href="#reservations" title="Reservations" aria-label="Reservations">
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18M8 14h3M8 17h6"/></svg>
                <span>Reservations</span>
            </a>
            <a class="admin-nav-link" href="#services" title="Services" aria-label="Services">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M7 4v6M17 4v6M5 12h14v8H5z"/><path d="M9 16h6"/></svg>
                <span>Services</span>
            </a>
            <a class="admin-nav-link" href="#analytics" title="Analytics" aria-label="Analytics">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V11M10 20V5M16 20v-8M22 20V8"/></svg>
                <span>Analytics</span>
            </a>
            <a class="admin-nav-link" href="{{ route('home') }}" title="View website" aria-label="View website">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 10v10h13V10M9 20v-6h6v6"/></svg>
                <span>Website</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <span class="sidebar-status-dot"></span>
            <span>System online</span>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="sidebar-logout" type="submit" title="Log out" aria-label="Log out">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 4H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5M16 16l5-4-5-4M21 12H9"/></svg>
                </button>
            </form>
        </div>
    </aside>

    <main class="admin-main" id="overview">
        <header class="admin-topbar">
            <div>
                <p class="topbar-kicker">BARBERHUB / ADMINISTRATION</p>
                <h1>Dashboard overview</h1>
            </div>
            <div class="topbar-actions">
                <div class="today-chip">
                    <span class="today-icon">◷</span>
                    <span>{{ now()->format('D, M d, Y') }}</span>
                </div>
                <div class="admin-profile">
                    <div class="profile-avatar">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="profile-copy">
                        <strong>{{ auth()->user()->name }}</strong>
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="admin-content">
            <div class="welcome-row">
                <div>
                    <h2>Good day, {{ explode(' ', auth()->user()->name)[0] }} <span class="wave">✦</span></h2>
                    <p>Here’s what’s happening at your barbershop today.</p>
                </div>
                <a class="view-site-button" href="{{ route('home') }}" target="_blank" rel="noopener">Visit website <span>↗</span></a>
            </div>

            <div class="metric-grid">
                <article class="metric-card metric-confirmed">
                    <div class="metric-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg></div>
                    <div class="metric-label">Confirmed bookings</div>
                    <div class="metric-value">{{ number_format($confirmedCount) }}</div>
                    <div class="metric-foot"><span class="metric-dot"></span> Approved appointments</div>
                </article>
                <article class="metric-card metric-pending">
                    <div class="metric-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
                    <div class="metric-label">Pending requests</div>
                    <div class="metric-value">{{ number_format($pendingCount) }}</div>
                    <div class="metric-foot"><span class="metric-dot"></span> Awaiting confirmation</div>
                </article>
                <article class="metric-card metric-cancelled">
                    <div class="metric-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m7 7 10 10M17 7 7 17"/></svg></div>
                    <div class="metric-label">Cancelled bookings</div>
                    <div class="metric-value">{{ number_format($cancelledCount) }}</div>
                    <div class="metric-foot"><span class="metric-dot"></span> Cancelled appointments</div>
                </article>
                <article class="metric-card metric-total">
                    <div class="metric-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4V20M9.5 10.5a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM17 4.5a4 4 0 0 1 0 7.8M18 14.5a4 4 0 0 1 3 3.9V20"/></svg></div>
                    <div class="metric-label">Total customers</div>
                    <div class="metric-value">{{ number_format($customersCount) }}</div>
                    <div class="metric-foot"><span class="metric-dot"></span> Registered accounts</div>
                </article>
            </div>

            <div class="dashboard-grid">
                <section class="dashboard-panel reservations-panel" id="reservations">
                    <div class="panel-heading">
                        <div>
                            <span class="panel-eyebrow">BOOKING MANAGEMENT</span>
                            <h3>Recent reservations</h3>
                        </div>
                        <a href="#reservations" class="panel-link">Latest activity <span>↗</span></a>
                    </div>
                    <div class="table-tools">
                        <label class="admin-search">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/></svg>
                            <input type="search" id="bookingSearch" placeholder="Search customer, barber or service…" aria-label="Search reservations">
                        </label>
                        <select id="bookingStatus" class="status-filter" aria-label="Filter reservations by status">
                            <option value="all">All statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="table-wrap">
                        <table class="booking-table">
                            <thead><tr><th>Customer</th><th>Service</th><th>Date &amp; time</th><th>Barber</th><th>Amount</th><th>Status</th></tr></thead>
                            <tbody id="bookingRows">
                                @forelse($appointments as $appointment)
                                    <tr data-status="{{ strtolower($appointment->status) }}" data-search="{{ strtolower(($appointment->customer->name ?? '') . ' ' . ($appointment->service->name ?? '') . ' ' . ($appointment->barber->name ?? '') . ' ' . $appointment->appointment_code) }}">
                                        <td><div class="customer-cell"><span class="customer-avatar">{{ mb_strtoupper(mb_substr($appointment->customer->name ?? 'C', 0, 1)) }}</span><span><strong>{{ $appointment->customer->name ?? 'Customer' }}</strong><small>{{ $appointment->appointment_code }}</small></span></div></td>
                                        <td>{{ $appointment->service->name ?? 'Service' }}</td>
                                        <td><strong class="date-main">{{ $appointment->appointment_date?->format('M d, Y') }}</strong><small class="date-sub">{{ \Illuminate\Support\Carbon::parse($appointment->start_time)->format('h:i A') }}</small></td>
                                        <td>{{ $appointment->barber->name ?? 'Unassigned' }}</td>
                                        <td class="amount-cell">{{ $appointment->price_is_quote ? 'For quotation' : '₱' . number_format((float) $appointment->price, 2) }}</td>
                                        <td><span class="status-badge status-{{ strtolower($appointment->status) }}">{{ ucfirst($appointment->status) }}</span></td>
                                    </tr>
                                @empty
                                    <tr class="empty-row"><td colspan="6"><div class="empty-state"><span>✂</span><strong>No reservations yet</strong><small>New customer bookings will appear here.</small></div></td></tr>
                                @endforelse
                                <tr id="noSearchResults" class="empty-row" hidden><td colspan="6">No reservations match your search.</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-foot"><span>Showing {{ $appointments->count() }} of {{ $appointmentsCount }} reservations</span><span>Updated {{ now()->format('h:i A') }}</span></div>
                </section>

                <aside class="side-column">

                    
                    <section class="dashboard-panel quick-stats-panel">
                        <div class="panel-heading compact-heading"><div><span class="panel-eyebrow">SHOP PULSE</span><h3>Business at a glance</h3></div></div>
                        <div class="quick-stat-row"><span class="quick-stat-icon icon-teal">▦</span><span><small>Today’s appointments</small><strong>{{ number_format($todayAppointmentsCount) }}</strong></span></div>
                        <div class="quick-stat-row"><span class="quick-stat-icon icon-violet">✂</span><span><small>Active barbers</small><strong>{{ number_format($barbersCount) }}</strong></span></div>
                        <div class="quick-stat-row"><span class="quick-stat-icon icon-orange">✉</span><span><small>Unread messages</small><strong>{{ number_format($unreadMessagesCount) }}</strong></span></div>
                    </section>

                    <section class="dashboard-panel services-panel" id="services">
                        <div class="panel-heading compact-heading"><div><span class="panel-eyebrow">CUSTOMER FAVORITES</span><h3>Popular services</h3></div></div>
                        @forelse($topServices as $index => $service)
                            <div class="popular-service">
                                <span class="service-rank">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="popular-service-info"><strong>{{ $service->name }}</strong><small>{{ number_format($service->appointments_count) }} bookings</small></span>
                                <span class="service-mini-bar"><i style="width: {{ $topServices->first()->appointments_count > 0 ? max(4, ($service->appointments_count / $topServices->first()->appointments_count) * 100) : 4 }}%"></i></span>
                            </div>
                        @empty
                            <p class="panel-empty-note">Service popularity will appear after the first booking.</p>
                        @endforelse
                    </section>
                </aside>
            </div>

            <div class="analytics-grid" id="analytics">
                <section class="dashboard-panel trend-panel">
                    <div class="panel-heading">
                        <div><span class="panel-eyebrow">BOOKING ACTIVITY</span><h3>Appointments over time</h3></div>
                        <span class="chart-period">Last 6 months</span>
                    </div>
                    <div class="trend-chart" role="img" aria-label="Monthly appointments for the last six months">
                        @foreach($monthlyBookings as $month)
                            <div class="trend-column" title="{{ $month['label'] }}: {{ $month['count'] }} bookings">
                                <span class="trend-count">{{ $month['count'] }}</span>
                                <div class="trend-bar-track"><i style="height: {{ $maxMonthlyBookings > 0 ? max(5, ($month['count'] / $maxMonthlyBookings) * 100) : 5 }}%"></i></div>
                                <span class="trend-month">{{ $month['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section class="dashboard-panel inventory-panel">
                    <span class="panel-eyebrow">SERVICE CATALOG</span>
                    <h3>Keep the shop ready</h3>
                    <p>Your live catalog currently has <strong>{{ number_format($servicesCount) }} active services</strong>. Review your services and barbers from the public website.</p>
                    <a href="{{ route('home') }}#services" class="catalog-link">View service catalog <span>↗</span></a>
                </section>
            </div>

            <footer class="admin-footer"><span>© {{ date('Y') }} BarberHub Admin Workspace</span><span>Private management area</span></footer>
        </section>
    </main>
</div>
@endsection
