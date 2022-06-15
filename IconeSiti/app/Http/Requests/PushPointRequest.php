<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushPointRequest extends FormRequest
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
            'top'=>'required|max:30',
            'allInform'=>'required|max:300',
            'coords'=>'required',
            'image'=>'image|max:5120',
        ];
    }

    public function messages(){
                    
        return [
            'top.required'=>'Заголовок обязателен',
            'coords.required'=>'Поставте точку на карте',
            'top.max'=>'Заголовок должен быть не больше 30 символов, на то он и заголовок',
            'allInform.required'=>'Описание и созданодлятого чтобы описать вашу ситуацию',
            'allInform.max'=>'Мы рады за ваше сочинение, но описанее не дольшно быть больше 300 символов',
            'image.image'=>'Картинка на то и картинка чтобы быть ей, только JPG ! ну или хотябы png',
            'image.max'=>'Мы рады что на вашем телефоне сто тысяч мегопикселей, но сервер не резиновый :)',
        ];
    }
}
