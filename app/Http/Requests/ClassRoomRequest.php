<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
            'List_Classes.*.name_ar' => 'required|unique:classroom,name_class->ar',
            'List_Classes.*.name_en' => 'required|unique:classroom,name_class->en',
        ];
    }


    public function messages()
    {
        return [
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'name_ar.unique'=>__('validation.name_ar_unique'),
            'name_en.unique'=>__('validation.name_en_unique'),
        ];
    }
}



