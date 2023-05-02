<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableSeatsRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\AvailableSeatsResource;
use App\Models\Reservation;
use App\Models\Trip;
use App\Services\AvailableSeatsService;

class ReservationController extends Controller
{
    public function getAvailableSeats(Trip $trip, AvailableSeatsRequest $request)
    {

        $sets = AvailableSeatsService::get($trip, $request->from_station, $request->to_station);

        return AvailableSeatsResource::collection($sets);

    }

    public function reservationSeat(Trip $trip, ReservationRequest $request)
    {

        $viaStations = $trip->stationsBetweenStartAndEnd($request->from_station_id, $request->to_station_id);

        $reservStations = [];
        for ($i = 0; $i < ($viaStations->count() - 1); $i++) {
            $reservStations[] = [
                'from_station_id' => $viaStations[$i],
                'to_station_id' => $viaStations[$i + 1],
            ];
        }
        $code = uniqid();

        foreach ($reservStations as $stations) {
            $data = $request->except(['from_station_id,to_station_id']);
            $data['from_station_id'] = $stations['from_station_id'];
            $data['to_station_id'] = $stations['to_station_id'];
            $data['code'] = $code;

            $reservation = $trip->reservation()->create($data);
        }
        return response()->json(['code' => $reservation->code], 201);
    }

}
