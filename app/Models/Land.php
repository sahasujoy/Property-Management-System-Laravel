<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $table = 'lands';
    
    protected $fillable = [
        'mouza_name',
        'size',
        'kcs',
        'ksa',
        'krs',
        'kbs',
        'dcs',
        'dsa',
        'drs',
        'dbs',
        'address',
        'image',
    ];

    public function buildings()
    {
        return $this->hasMany(Bulding::class, 'land_id', 'id');
    }
}
