<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
        return [
			'number' => 'required',
			'name' => 'required',
			'order_sum' => 'required',
//			'currency_id' => 'required',
			'paid_at' => 'required',
        ];
    }

    /**
     * Ответ в случае ошибок валидации запроса
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'При обработке запроса возникли ошибки',
            'data'      => $validator->errors()
        ]));
    }
}
