<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AvtorizatRequest;
use App\Http\Requests\LoginInRequest;
use App\Models\User;
use App\Http\Requests\PushPointRequest;
use App\Models\PushPointModel;
use App\Models\LikeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvtorizatController extends Controller
{
    public function showLoginForm()
    {
        return view('loginMenu');
    }

    public function showregistratForm()
    {
        return view('registratMenu');
    }

    public function registration(AvtorizatRequest $data)
    {
        $user = User::create([
            "name" => $data["login"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"])
        ]);

        if ($user) {
            auth("web")->login($user);
        }

        return redirect(route('mainWindos'));
    }

    public function loginIn(LoginInRequest $data)
    {
        $user = [
            "email" => $data["email"],
            "password" => $data["password"]
        ];
        if (auth("web")->attempt($user)) {
            return redirect(route('mainWindos'));
        }
        return redirect(route('login'))->withErrors(["email" => 'Пользователь не найден или не верные данные']);
    }

    public function inPersonalKabun()
    {
        $dataPersonal = PushPointModel::where('avtor_id', Auth::user()->id)->get()->toArray();
        $i = 0;
        foreach ($dataPersonal as $point) {
            $like = LikeModel::where('post_id', $point['id'])->get()->toArray();
            $dataPersonal[$i]["valuLike"] = count($like);
            $i++;
        }
        return view('personalKabunet', ['data' => $dataPersonal]);
    }

    public function upDatePostStanId($id){
        return redirect(route('upDatePost', ['id' => $id]));
    }

    public function upDatePostStan(Request $id){
        return view('personalKabunetUdate',['data' => PushPointModel::find($id->input('id'))]);
    }

    public function upDatePostStanSend(PushPointRequest $data)
    {
        $contacte = PushPointModel::find($data->input('id'));
        $contacte->top = $data->input('top');
        $contacte->allInform = $data->input('allInform');
        $contacte->coords = $data->input('coords');
        $contacte->typePoint = $data->input('typePoint');
        if ($data->file('image')) {
            $foto = $contacte->image;
            $nameFoto = explode("/", $foto);
            Storage::delete('/public/uploads/' . array_pop($nameFoto));

            $path = $data->file('image')->store('uploads', 'public');
            $url = asset('/storage/' . $path);
            $contacte->image = $url;
        }
        $contacte->save();
        return redirect()->route('personalKabunet');
    }

    public function showloginOutForm()
    {
        auth("web")->logout();
        return redirect(route('mainWindos'));
    }
}
