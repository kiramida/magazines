<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthor extends FormRequest
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
            /*'name' => 'required|max:255',
            'patronymic' => 'max:255',
            'surname' => 'required|min:3|max:255',*/
            'name.*' => 'required|max:255',
            'patronymic.*' => 'max:255',
            'surname.*' => 'required|min:3|max:255',
        ];
    }    
    
}
