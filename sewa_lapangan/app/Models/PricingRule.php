<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    use HasFactory;
    protected $fillable = ['field_id', 'day_type', 'time_type', 'price_per_hour'];

    public function field()
    {
        // Nama method 'field' ini akan menjadi nama relasi yang bisa kita panggil: $rule->field
        return $this->belongsTo(Field::class);
    }
}
