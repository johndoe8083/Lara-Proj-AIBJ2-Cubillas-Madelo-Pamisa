<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration_minutes', 'image', 'is_active', 'is_custom_priced'];

    protected function casts(): array
    {
        return ['price' => 'decimal:2', 'is_active' => 'boolean'];
    }

    public function appointments(): HasMany { return $this->hasMany(Appointment::class); }
}
