<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barber extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'specialty', 'bio', 'photo', 'is_active'];

    protected function casts(): array { return ['is_active' => 'boolean']; }

    public function schedules(): HasMany { return $this->hasMany(BarberSchedule::class); }
    public function appointments(): HasMany { return $this->hasMany(Appointment::class); }
}
