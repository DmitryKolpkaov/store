<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'code'=>'required|min:4|max:20',
            'name'=>'required|min:4|max:255',
            'description'=>'required|min:20',
        ];

        if($this->route()->named('categories.store')){
            $rules['code'] = '|unique:categories,code';
        }else{
            $rules['code'] = '|unique:categories,code';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required'=> 'Поле :attribute обязательно для заполнения!',
            'min'=> 'Поле :attribute должно содержать минимум :min символов!',
            'max'=> 'Поле :attribute должно содержать минимум :max символов!',
            'unique'=> 'Поле :attribute c таким названием уже существует!'
        ];
    }
}
