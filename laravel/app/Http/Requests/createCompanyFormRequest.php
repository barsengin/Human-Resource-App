<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company;

class createCompanyFormRequest extends FormRequest
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
        $rules['company_name'] = ['required'];
        $rules['company_logo_file'] = ['image','dimensions:min_height=100, min_width=100'];
        $rules['company_phone'] = ['min:9', 'max:11'];
        return $rules;
    }

    public function attributes()
    {
        return [
            'company_name' => "Firma Adı",
            'company_phone' => "Firma Telefonu",
            'company_logo' => "Logo"
        ];
    }
    public function messages()
    {
        return [
            'company_logo.image'=>'Firma Logosu .png .jpg .jpeg uzentılı dosya olmalıdır',
            'company_name.required'=>'Firma Adı zorunludur',
            'company_phone.min'=>'Firma Telefonu 10 haneli olmalıdır',
            'company_phone.max'=>'Firma Telefonu 10 haneli olmalıdır'
        ];
    }
}
