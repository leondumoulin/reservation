<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'user_id',
        'trip_id',
        'seat_id',
        'from_station_id',
        'to_station_id',
        'status',
    ];
}
