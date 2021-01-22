<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagazine extends FormRequest
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
            'name' => 'required|max:255',
            'short_description' => 'max:500',
            'authors' => 'required',
            'image' => 'mimes:jpeg,png|max:2048',
            'issue_date' => 'nullable|date'
        ];
    }
    
    /**
      * Get the error messages for the defined validation rules.
      *
      * @return array
      
    public function messages()
    {
        return [
           'name.required' => 'Введите название журнала',
           'name.max' => 'Не более 255 символов',
           'short_description.max' => 'Не более 500 символов',
           'authors.required' => 'Выберите хотя бы одного автора',
           'image.mimes' => 'Загрузите изображение jpg или png',
           'image.size' => 'Загрузите изображение не больше 2Mb',
           'issue_date.date' => 'Введите корректную дату'
        ];
    }*/
}
