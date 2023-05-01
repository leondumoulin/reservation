<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function start()
    {
        return $this->viastations()->first();
    }

    public function end()
    {
        return $this->viastations()->orderBy('sequence', 'DESC')->first();
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function viastations()
    {
        return $this->hasMany(Viastation::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function stationsBetweenStartAndEnd($start, $end)
    {
        $startSequence = $this->viastations()->where('station_id', $start)->first()->sequence;
        $endSequence = $this->viastations()->where('station_id', $end)->first()->sequence;
        return $this->viastations()->whereBetween('sequence', [$startSequence, $endSequence])->pluck('station_id');
    }

}
