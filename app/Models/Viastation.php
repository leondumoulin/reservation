<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viastation extends Model
{
    use HasFactory;

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
