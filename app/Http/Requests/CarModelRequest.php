<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Models\CarBrandModel;

use App\Http\Traits\ResponseTemplate;

class CarModelRequest extends FormRequest
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

        $model = request()->route('car_brand');

        // $target_obj = new CarBrandModel;
        // $ar_names = $target_obj->pluck('ar_name')->toArray();
        // $en_names = $target_obj->pluck('en_name')->toArray();

        return [
            'ar_name'  => [
                'required', 'max:255', 
                Rule::unique('car_brand_models')->where(function ($q) use ($model) {
                    isset($model) && $q->where('id', '!=', $model);

                    $q->where('category', 'brand');
                })
            ],

            'en_name'  => [
                'required', 'max:255', 
                Rule::unique('car_brand_models')->where(function ($q) use ($model) {
                    isset($model) && $q->where('id', '!=', $model);

                    $q->where('category', 'brand');
                })
            ],

            'models' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'ar_name.unique'  => __('car_brands.name_unique'),
            'en_name.unique'  => __('car_brands.name_unique'),
            
            'ar_name.unique'  => __('car_brands.name_unique'),
            'en_name.unique'  => __('car_brands.name_unique'),
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
