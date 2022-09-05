<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = "registrations";

    protected $fillable = [
        'file_no',
        'customer_id',
        'flat_id',
        'date',
        'sub_deed_no',
    ];

    public function statuses()
    {
        return $this->hasOne(Status::class, 'registration_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function prices()
    {
        return $this->hasOne(Price::class, 'registration_id', 'id');
    }

    public function payments()
    {
        return $this->hasOne(Payment::class, 'registration_id', 'id');
    }

    public function flats()
    {
        return $this->belongsTo(Flat::class, 'flat_id');
    }
}
