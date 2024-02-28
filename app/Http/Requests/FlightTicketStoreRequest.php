<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightTicketStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'flight_seat_id' => 'required|exists:airports,id',
            'passenger_id' => 'sometimes|exists:users,id',
            'passenger_name' => 'required_without:passenger_id',
            'passenger_cpf' => 'required_without:passenger_id',
            'passenger_birth' => 'required_without:passenger_id',
            'needs_dispatch' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'flight_seat_id.required' => 'O campo flight_seat_id é obrigatório.',
            'flight_seat_id.exists' => 'O valor fornecido para flight_seat_id não é válido.',
            'passenger_id.exists' => 'O valor fornecido para passenger_id não é válido.',
            'passenger_name.required_without' => 'O campo passenger_name é obrigatório quando passenger_id não está presente.',
            'passenger_cpf.required_without' => 'O campo passenger_cpf é obrigatório quando passenger_id não está presente.',
            'passenger_birth.required_without' => 'O campo passenger_birth é obrigatório quando passenger_id não está presente.',
            'passenger_birth.date_format' => 'O campo passenger_birth deve estar no formato dd/mm/yyyy quando passenger_id não está presente.',
            'needs_dispatch.required' => 'O campo needs_dispatch é obrigatório.',
            'needs_dispatch.boolean' => 'O campo needs_dispatch deve ser verdadeiro (true) ou falso (false).',
        ];
    }
}
