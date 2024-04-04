<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
    // Ottieni l'ID corrente dell'elemento (assumendo che sia passato tramite la richiesta)

    return [
        'nome_progetto' => [
            'required',
            Rule::unique('projects')->ignore($this->project), // Ignora l'elemento corrente durante l'aggiornamento
            'max:150'
        ],
        'descrizione_progetto' => ['required'],
        'linguaggi' => ['required','max:1024'],
        'type_id' => ['nullable','exists:types,id'],
        'technologies' => ['exists:technologies,id']
    ];
}
}
