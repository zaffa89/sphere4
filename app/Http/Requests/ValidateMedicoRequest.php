<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateMedicoRequest extends FormRequest
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
            'codice_fiscale' => 'nullable',
            'telefono' => 'nullable|string|max:15',
            'telefono_fisso' => 'nullable|string|max:15',
            'email' => 'nullable|email',

            'colore' => 'nullable',
            'partita_iva' => 'nullable',
            'identificativo_fmsi' => 'nullable',
            'codice_tracciato' => 'nullable',
            'timbro' => 'nullable',
            
            'abilitazione_medsport' => 'boolean',
            'abilitazione_ambulatoriale' => 'boolean',
            'abilitazione_cardiologia' => 'boolean',
            'abilitazione_fisioterapia' => 'boolean',

            'attivo' => 'boolean'      
        ];
    }

    public function messages() {
        return [
            'ragione_sociale.required' => "Cognome e nome del medico sono obbligatori",
            'telefono' => 'Il numero di telefono deve essere al massimo 15 numeri',
            'telefono_fisso' => 'Il numero di telefono fisso deve essere al massimo 15 numeri',
            'email' => "L'indirizzo email inserito non è valido"            
        ];
    }
}
