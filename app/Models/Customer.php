<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        'customer_id',
        'name',
        'phone',
        'email',
        'address',
        'country',
        'nid',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'customer_id', 'id');
    }
}
