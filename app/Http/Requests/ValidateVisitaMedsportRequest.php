<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateVisitaMedsportRequest extends FormRequest
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

    protected function prepareForValidation()
    {

        //$this->merge([]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data_visita' => 'required',
            'medico_id' => 'required',
            'listino_id' => 'required',
            'paziente_id' => 'required',
            'societa_id' => config('sphere.societa_obbligatoria') ? 'exclude_if:visita_privata,true|required_if:listino.agonistico,true|integer' : 'nullable',
            'sport_id' => 'required_if:listino.agonistico,true'
        ];
    }

    public function messages() {
        return [
            'paziente_id' => 'Non hai selezionato il PAZIENTE',
            'medico_id.required' => 'Non hai selezionato il MEDICO',            
            'listino_id.required' => 'Non hai selezionato la prestazione dal listino',
            'societa_id.required_if' => 'La società sportiva è richiesta per le visite agonistiche non private',
            'sport_id.required_if' => 'Lo SPORT è richiesto per le visite agonistiche'
        ];
    }
}
