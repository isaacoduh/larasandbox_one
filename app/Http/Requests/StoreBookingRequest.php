<?php

namespace App\Http\Requests;

use App\Booking;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('booking'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_from_id' => [
                'required',
                'integer',
            ],
            'date_from'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'city_to_id'   => [
                'required',
                'integer',
            ],
            'date_to'      => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'adults'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'children'     => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
