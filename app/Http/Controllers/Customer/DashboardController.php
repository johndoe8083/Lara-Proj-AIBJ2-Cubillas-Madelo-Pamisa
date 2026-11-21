<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $appointments = $request->user()->appointments()
            ->with(['barber', 'service', 'payment'])->latest()->get();

        return view('customer.dashboard', compact('appointments'));
    }
}
