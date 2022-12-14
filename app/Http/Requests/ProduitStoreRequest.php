<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => ['required', 'string', 'max:10'],
            'slug' => ['required', 'string'],
            'prix' => ['required', 'integer'],
            'is_available' => ['required'],
            'titre' => ['required', 'string', 'max:10'],
            'slug' => ['required', 'string'],
            'prix' => ['required', 'integer'],
            'is_available' => ['required'],
            'is_available' => ['required'],
        ];
    }
}
