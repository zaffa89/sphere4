<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePazienteRequest extends FormRequest
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
            'nome' => 'required',
            'cognome' => 'required',
            'data_nascita' => 'required|date_format:Y-m-d',
            'sesso' => 'required|in:M,F',
            'codice_fiscale' => 'nullable|size:16|alpha_num'
        ];
    }

    public function messages() {
        return [
            'nome.required' => "Non hai inserito il nome",
            'cognome.required' => 'Non hai inserito il cognome',
            'data_nascita.required' => 'Non hai inserito la data di nascita',
            'sesso.required' => 'Non hai specificato il SESSO',
            'codice_fiscale' => "Codice Fiscale non valido"
        ];
    }
}
