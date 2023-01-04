<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePrenotazioneRequest extends FormRequest
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
            'sezione_visita' => 'nullable|required',
            'data_inizio' => 'required',           
            'struttura_id' => 'required',
            'ambulatorio_id' => 'required',            
            'medico_id' => 'nullable',
            'note' => 'nullable|max:255',
            'durata' => 'required|integer|min:1',
            'visita.prestazione_id' => 'required_if:sezione_visita,M,A',
            'societa_id' => 'required_if:sezione_visita,SM,SA',
            'sport_id' => 'nullable',
            'visita.paziente_id' => 'required_if:sezione_visita,M,A'            
        ];
    }

    public function messages() {
        return [
            'paziente_id.required_unless' => "Non hai selezionato il paziente",
            'data_inizio.required' => "Non hai inserito la data della visita",
            'durata.required' => 'Non hai specificato la DURATA della visita',
            'durata.integer' => 'La durata della visita deve essere un numero intero',
            'durata.min' => 'La durata della visita deve essere almeno 1 minuto',
            'struttura_id.required' => 'Non hai specificato la STRUTTURA',
            'ambulatorio_id' => 'Non hai selezionato un AMBULATORIO',
            'medico_id' => 'Non hai selezionato il MEDICO',
            'note.max' => 'Il testo nelle note deve essere inferiore a 255 caratteri',
            'visita.prestazione_id.required_unless' => 'Non hai selezionato la prestazione'
        ];
    }
}