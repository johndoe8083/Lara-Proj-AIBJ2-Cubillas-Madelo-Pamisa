<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_code', 'user_id', 'barber_id', 'service_id',
        'appointment_date', 'start_time', 'end_time', 'price',
        'status', 'customer_notes', 'admin_notes', 'price_is_quote',
    ];

    protected function casts(): array
    {
        return ['appointment_date' => 'date', 'price' => 'decimal:2', 'price_is_quote' => 'boolean'];
    }

    public function customer(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
    public function barber(): BelongsTo { return $this->belongsTo(Barber::class); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
    public function payment(): HasOne { return $this->hasOne(Payment::class); }
}
