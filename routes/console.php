<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('barberhub:about', function () {
    $this->comment('BarberHub - Barbershop Appointment Management System');
})->purpose('Display BarberHub project information');
