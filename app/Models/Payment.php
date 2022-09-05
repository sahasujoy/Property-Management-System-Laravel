<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    protected $fillable = [
        'registration_id',
        'land_reg_cost',
        'mutation_cost',
        'flat_reg_cost',
        'poa_cost',
        'booking_money',
        'downpayment',
        'land_piling_money1',
        'land_piling_money2',
        'building_piling',
        'first_roof_cast',
        'top_roof_cast',
        'final_work_cost',
        'car_parking',
        'installments',
    ];

    public function registrations()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
