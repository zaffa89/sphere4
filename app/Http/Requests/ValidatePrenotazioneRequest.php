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
            'visita.listino_id' => 'required',
            'societa_id' => 'required_if:sezione_visita,SM,SA',
            'visita.sport_id' => 'nullable',
            'visita.paziente_id' => 'required_if:sezione_visita,M,A',
            'numero_paz' => 'required_if:sezione_visita,SM,SA|min:1'
        ];
    }

    public function messages() {
        return [
            'visita.paziente_id.required_unless' => "Non hai selezionato il paziente",
            'data_inizio.required' => "Non hai inserito la data della visita",
            'durata.required' => 'Non hai specificato la DURATA della visita',
            'durata.integer' => 'La durata della visita deve essere un numero intero',
            'durata.min' => 'La durata della visita deve essere almeno 1 minuto',
            'struttura_id.required' => 'Non hai specificato la STRUTTURA',
            'ambulatorio_id' => 'Non hai selezionato un AMBULATORIO',
            'medico_id' => 'Non hai selezionato il MEDICO',
            'note.max' => 'Il testo nelle note deve essere inferiore a 255 caratteri',
            'visita.listino_id.required' => 'Non hai selezionato la voce del listino',
            'societa_id.required_if' => 'Non hai selezionato la società sportiva',
            'numero_paz.required_if' => 'Non hai specificato il numero di atleti/pazienti',
            'visita.sport_id.required_if' => 'Non hai selezionato lo sport'
        ];
    }
}