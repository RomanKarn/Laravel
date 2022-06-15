<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvtorizatRequest extends FormRequest
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
            'login'=>'required|string|max:30',
            'email'=>'required|email|string|max:30|unique:users,email',
            'password'=>'required|confirmed',
        ];
    }
    public function messages(){
                    
        return [
            'login.required'=>'Логин обязателен',
            'login.string'=>'Это должно быть строкой, хотя я не знаю как вы так умудрились',
            'login.max'=>'Логин ссооооууу логн',
            'email.required'=>'Почта нужна всегда',
            'email.email'=>'Почта должна быть почтой со всеми знаками @ ',
            'email.string'=>'Это должно быть строкой, хотя я не знаю как вы так умудрились',
            'email.max'=>'У вас удевительно большая почта',
            'email.unique'=>'Кто-то уже зарегестрирован с такой почтой',
            'password.required'=>'Пороль обязателен',
            'password.confirmed'=>'Пороли не совподают',
        ];
    }
}
