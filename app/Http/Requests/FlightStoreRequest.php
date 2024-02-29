<?php

namespace App\Http\Requests;

use App\Rules\SameCityAsOrigin;
use App\Rules\TotalClassSeatsLimit;
use Illuminate\Foundation\Http\FormRequest;

class FlightStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'airport_origin_id' => 'required|exists:airports,id',
            'airport_destination_id' => [
                'required',
                'exists:airports,id',
                new SameCityAsOrigin($this->input('airport_origin_id')),
            ],
            'flight_date' => 'required|date_format:d/m/Y|after_or_equal:' . now()->format('d/m/Y'),
            'departure_time' => 'required|date_format:H:i:s',
            'seats_qty' => 'required',
            'flight_classes' => [
                'required',
                'array',
                new TotalClassSeatsLimit($this->input('seats_qty')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'airport_origin_id.required' => 'O campo origem é obrigatório.',
            'airport_origin_id.exists' => 'A origem selecionada não existe.',
            'airport_destination_id.required' => 'O campo destino é obrigatório.',
            'airport_destination_id.exists' => 'O destino selecionado não existe.',
            'flight_date.required' => 'O campo data do voo é obrigatório.',
            'flight_date.date_format' => 'O campo data do voo deve estar no formato d/m/Y.',
            'flight_date.after_or_equal' => 'O campo data do voo deve ser igual ou posterior à data atual.',
            'departure_time.required' => 'O campo horário de partida é obrigatório.',
            'departure_time.date_format' => 'O campo horário de partida deve estar no formato H:i:s.',
            'flight_classes.required' => 'É necessário informar pelo menos uma classe para o vôo'
        ];
    }
}