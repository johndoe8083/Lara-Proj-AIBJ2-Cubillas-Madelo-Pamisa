<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __invoke()
    {
        $services = Schema::hasTable('services')
            ? Service::query()->where('is_active', true)->where('name', '!=', 'Pompadour Styling')->orderByRaw("CASE WHEN name = 'Custom Cut' THEN 8 ELSE id END")->orderBy('id')->get()
            : collect();

        $barbers = Schema::hasTable('barbers')
            ? Barber::query()->where('is_active', true)->orderBy('id')->get()
            : collect();

        return view('home', compact('services', 'barbers'));
    }
}
