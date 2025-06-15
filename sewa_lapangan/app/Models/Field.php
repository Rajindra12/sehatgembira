<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name', 'address', 'category', 'description', 'image', 'open_time', 'close_time', 'status'
    ];

    public function pricingRules()
    {
        return $this->hasMany(PricingRule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getStatusColorClassAttribute(): string
    {
        switch ($this->status) {
            case 'available':
                return 'bg-green-200 text-green-900';
            case 'maintenance':
                return 'bg-yellow-200 text-yellow-900';
            case 'closed':
                return 'bg-red-200 text-red-900';
            default:
                return 'bg-gray-200 text-gray-900';
        }
    }
}
