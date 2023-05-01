<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TripHasStationRule implements Rule
{

    protected $trip;

    public function __construct($trip)
    {
        $this->trip = $trip;
    }

    public function passes($attribute, $value)
    {
        return $this->trip->viastations()->where('station_id', $value)->get()->count() > 0;
    }

    public function message()
    {
        return 'المحطة غير متاحة بالرحلة';
    }
}
