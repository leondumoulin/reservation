<?php

namespace App\Http\Requests;

use App\Rules\SeatAvailableRule;
use App\Rules\TripHasStationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => 1,
            'trip_id' => $this->trip->id,
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $rules = [
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
            'seat_id' => ['required', 'exists:seats,id', new SeatAvailableRule($this->trip, $this->all())],
            'status' => 'required|in:held,booked',
            'from_station_id' => ['required', 'exists:stations,id', new TripHasStationRule($this->trip)],
            'to_station_id' => ['required', 'exists:stations,id', new TripHasStationRule($this->trip)],
        ];

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json(
            $validator->errors()->toArray(),
            422
        ));
    }
}
