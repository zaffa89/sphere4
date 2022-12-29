<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAmbulatorioRequest extends FormRequest
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
        $this->merge([
                     
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
            'struttura_id' => 'required|integer|exists:strutture,id',
            'ordine' => 'required|integer',
            'attivo' => 'boolean'
        ];
    }

    public function attributes()
    {
        return [
            
        ];
    }

    public function messages() {
        return [
            'nome.required' => "Non hai inserito il nome dell'ambulatorio",
            'struttura_id.required' => "Non hai selezionato a quale struttura appartiene questo ambulatorio",
            'struttura_id.exists' => "La struttura scelta non esiste",            
            'ordine.required' => "Campo 'Ordine' richiesto",
            'ordine.integer' => "'Ordine' deve essere un numero intero"
        ];
    }
}
