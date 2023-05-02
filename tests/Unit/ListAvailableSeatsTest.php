<?php

namespace Tests\Unit;

use Tests\TestCase;

class ListAvailableSeatsTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function testListAvailableSeats(): void
    {
        $this->json('get', '/api/available-seats/trip/1?from_station=3&to_station=5')
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        'id' => 1,
                        'number' => 1,
                    ],
                ],
            ])
            ->assertSee(1);
    }

    public function testRequiredTripForReservation()
    {
        $this->json('POST', '/api/reservation/trip/10', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "error" => "record not found",
            ]);
    }

    public function testSuccessfulReservation()
    {
        $userData = [
            "status" => "held",
            "seat_id" => "2",
            "from_station_id" => "1",
            "to_station_id" => "3",
        ];

        $this->json('POST', '/api/reservation/trip/1', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "code",
            ]);
    }

    public function testReservationSameSeatAgain()
    {
        $userData = [
            "status" => "held",
            "seat_id" => "2",
            "from_station_id" => "1",
            "to_station_id" => "3",
        ];

        $this->json('POST', '/api/reservation/trip/1', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "seat_id" => [
                    "الكرسي غير متاح",
                ],
            ]);
    }
}
