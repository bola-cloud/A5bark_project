<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Models\District;

use App\Http\Traits\ResponseTemplate;

class DistrictRequest extends FormRequest
{
    use ResponseTemplate;
    
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
    public function rules()
    {
        // dd($this);
        if (request()->filled('activate_object')) return [];

        $district = request()->route('district');

        // $target_obj    = new District;

        // $ar_names = $target_obj->pluck('ar_name')->toArray();
        // $en_names = $target_obj->pluck('en_name')->toArray();

        return [
            'ar_name'  => [
                'required', 'max:255', 
                Rule::unique('districts')->where(function ($q) use ($district) {
                    // return $q->where('category', 'gove');
                    
                    isset($district) && $q->where('id', '!=', $district);

                    $q->where('category', 'gove');
                })
            ],

            'en_name'  => [
                'required', 'max:255', 
                Rule::unique('districts')->where(function ($q) use ($district) {
                    // return $q->where('category', 'gove');

                    isset($district) && $q->where('id', '!=', $district);

                    $q->where('category', 'gove');
                })
            ],

            'geo_lat' => 'required|numeric',
            'geo_lng' => 'required|numeric',
            'centers' => 'nullable'
            // 'centers' => [
            //     'nullable', 
            //     function($attribute, $value, $fail) use ($en_names, $ar_names)  {
            //         $values = json_decode($value, true);
            //         foreach ($values as $value) {
            //             if (!isset($value['parent_id'])) {
            //                 if (in_array($value['ar_name'], $ar_names)) {
            //                     return $this->responseTemplate(null, false, 'distrct '.$value['ar_name'].' must be unique name !');
            //                 }
            //                 elseif (in_array($value['en_name'], $en_names)) {
            //                     return $this->responseTemplate(null, false, 'distrct '.$value['en_name'].' must be unique name !');
            //                 }
            //             }
            //         }
            //     }
            // ],
            
        ];
    }

    public function messages()
    {
        return [
            'ar_name.unique'  => __('district.name_unique'),
            'en_name.unique'  => __('district.name_unique'),
            
            'ar_name.unique'  => __('district.name_unique'),
            'en_name.unique'  => __('district.name_unique'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            $this->responseTemplate(null, false, $errors)
        );
    }

}
