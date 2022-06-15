<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginInRequest extends FormRequest
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
            'email'=>'required|email|string|max:30',
            'password'=>'required',
        ];
    }
    public function messages(){
                    
        return [
            'email.required'=>'Почта нужна всегда',
            'email.email'=>'Почта должна быть почтой со всеми знаками @ ',
            'email.string'=>'Это должно быть строкой, хотя я не знаю как вы так умудрились',
            'email.max'=>'У вас удевительно большая почта',
            'password.required'=>'Пороль обязателен',
        ];
    }
}
