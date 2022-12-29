<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSportRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'inizio_anno_riferimento' => $this->anno_di_riferimento === 3 ? trim($this->inizio_anno_riferimento) : null,
            'fine_anno_riferimento' => $this->anno_di_riferimento === 3 ? trim($this->fine_anno_riferimento) : null            
        ]);
       
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'tipo_visita' => 'required',
            'mesi_scadenza' => 'required|integer|min:1',

            'eta_minima_maschi' => 'required|lt:eta_massima_maschi|min:1',
            'eta_massima_maschi' => 'required|gt:eta_minima_maschi|min:2',
            'eta_minima_tem_maschi' => 'nullable|integer|min:1',
            'eta_minima_femmine' => 'required|lt:eta_massima_femmine|min:1',
            'eta_massima_femmine' => 'required|gt:eta_minima_femmine|min:2',
            'eta_minima_tem_femmine' => 'nullable|integer|min:1',

            'anno_di_riferimento' => 'required|integer|in:1,2,3',
            'inizio_anno_riferimento' => 'required_if:anno_di_riferimento,3|nullable|date_format:d/m',
            'fine_anno_riferimento' => 'required_if:anno_di_riferimento,3|nullable|date_format:d/m',
            
            'disabili' => 'boolean',
            'richiesto_gruppo_sanguigno' => 'boolean',
            'richiesto_eeg' => 'boolean',
            'prenotabile_online' => 'boolean'
        ];
    }

    public function attributes()
    {
        return [
            'eta_minima_maschi' => 'Età minima',
            'eta_massima_maschi' => 'Età massima',

            'eta_minima_femmine' => 'Età minima',
            'eta_massima_femmine' => 'Età massima',
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'Il nome nello sport è obbligatorio',

            'eta_minima_maschi.required' => "Età minima maschi obbligatoria",
            'eta_minima_maschi.lt' => "Età minima maschi deve essere inferiore all'età massima",
            'eta_massima_maschi.required' => 'Età massima maschi obbligatoria',
            'eta_massima_maschi.gt' => "Età massima maschi deve essere maggiore dell'età minima",

            'eta_minima_femmine.required' => "Età minima femmine obbligatoria",
            'eta_minima_femmine.lt' => "Età minima femmine deve essere inferiore all'età massima",
            'eta_massima_femmine.required' => "Età massima femmine obbligatoria",
            'eta_massima_femmine.gt' => "Età massima femmine deve essere maggiore dell'età minima",

            'anno_di_riferimento.required' => "L'anno di riferimento è obbligatorio",
            'tipo_visita.requied' => "Tipo visita è obbligatorio",
            'mesi_scadenza.required' => "Non hai inserito i mesi di scadenza",
            'mesi_scadenza.min' => "Mesi scadenza deve essere almeno 1"
        ];
    }
}
