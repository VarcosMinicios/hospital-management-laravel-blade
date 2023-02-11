<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
        $id = $this->route('id') ?? null;

        return [
            'name' => 'required|string|max:100',
            'rg' => 'string|max:20|nullable',
            'cpf' => 'required|string|max:14|unique:people,cpf,' . $id,
            'birth_date' => 'required|date_format:d/m/Y',
            'cns' => 'string|max:18|nullable',
            'father_name' => 'required_if:father_unknow,|string|max:100|nullable',
            'mother_name' => 'required|string|max:100',
            'father_unknow' => 'required_if:father_name,==,',
            'gender' => 'required|in:masculino,feminino',
            'skin_color' => 'required:exists:skin_colors:description',
            'profession' => 'required|string|max:30',
            'nationality' => 'required',
            'cep' => 'required|string|max:9',
            'state' => 'required|string|exists:states,abbreviation',
            'city' => 'required|string|max:50',
            'neighborhood' => 'required|string|max:60',
            'street_type' => 'required|string|max:60',
            'street' => 'required|string|max:70',
            'number' => 'required|numeric',
            'complement' => 'string|max:50|nullable',
            'ibge_code' => 'numeric|nullable',
            'reference' => 'string|max:50|nullable',
        ];
    }
}
