<?php

namespace App\Rules;

use App\Services\AvailableSeatsService;
use Illuminate\Contracts\Validation\Rule;

class SeatAvailableRule implements Rule
{

    protected $trip;
    protected $request;

    public function __construct($trip, $request)
    {
        $this->trip = $trip;
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        return (AvailableSeatsService::check($this->trip, $this->request['from_station_id'], $this->request['to_station_id'], $value));

    }

    public function message()
    {
        return 'الكرسي غير متاح';
    }
}
