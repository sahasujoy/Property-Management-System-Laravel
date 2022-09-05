<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = "prices";

    protected $fillable = [
        'registration_id',
        'land_reg_cost',
        'mutation_cost',
        'flat_reg_cost',
        'poa_cost',
        'flat_price',
        'utility_charge',
        'car_parking',
        'additional_cost',
        'installments',
    ];

    public function registrations()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
