<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

class createEmployeeFormRequest extends FormRequest
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
        $rules['company_id'] = ['required','in:'.implode(',', Company::where('id',request()->company_id)->get()->pluck('id')->toArray())];
        $rules['employee_first_name'] = ['required'];
        $rules['employee_last_name'] = ['required'];
        $rules['employee_phone'] = ['required', 'min:9', 'max:11'];
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'employee_first_name' => "Adı",
            'employee_last_name'=>'Soyadı',
            'employee_phone'=>'Telefon Numarası'
        ];
    }
    public function messages()
    {
        return [
            'employee_first_name.required'=>'Personel Adı zorunludur',
            'employee_last_name.required'=>'Personel Soyadı zorunludur',
            'employee_phone.required'=>'Personel Telefonu zorunludur',
            'employee_phone.min'=>'Personel Telefonu 10 haneli olmalıdır',
            'employee_phone.max'=>'Personel Telefonu 10 haneli olmalıdır'
        ];
    }
}
