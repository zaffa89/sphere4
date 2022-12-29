<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSocietaSportivaRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ragione_sociale' => 'required',
            'email' => 'nullable|email',
            'responsabile_email' => 'nullable|email',
            'presidente_email' => 'nullable|email',
            'pec' => 'nullable|email'
        ];
    }

    public function attributes()
    {
        return [
            
        ];
    }

    public function messages() {
        return [
            'ragione_sociale.required' => 'Non hai inserito la ragione sociale',
            'email.email' => "L'indirizzo email della società non è valido",
            'responsabile_email.email' => "L'indirizzo email del responsabile non è valido",
            'presidente_email.email' => "L'indirizzo email del presidente non è valido",
            'pec.email' => "L'indirizzo email PEC inserito non è valido",
        ];
    }
}
