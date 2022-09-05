<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $table = 'buildings';

    protected $fillable = [
        'land_id',
        'name',
        'road_no',
        'no',
        'face_direction',
        'location',
        'floors',
        'flats',
        'start_date',
        'complete_date',
        'complete_extended_date',
    ];

    public function lands()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }

    public function flats()
    {
        return $this->hasMany(Flat::class, 'building_id', 'id');
    }
}
