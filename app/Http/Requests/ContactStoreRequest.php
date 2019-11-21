<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;


class ContactStoreRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'second_name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'phone' => 'required|digits:11|unique:phones',
            //'email' => 'required|email:rfc,dns',
            'description' => 'string|max:250',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Имя клиента должно быть заполнено!',
            'second_name.required' => 'Отчество клиента должно быть заполнено!',
            'surname.required' => 'Фамилия клиента должна быть заполнено!',
            'phone.required' => 'Телефон клиента должен быть заполнен',
            'phone.digits' => 'Телефон клиента должен состоять из 11 цифр и начинаться на 7 или 8',
            'phone.unique' => 'Телефон клиента :attribute уже был внесен в базу ранее!',
            //'email.required' => 'Email клиента должно быть заполнен!',
            //'comment.max' => 'Максимальная длина коммента [:max]'
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse($validator->messages(), 422)
        );
    }
}
