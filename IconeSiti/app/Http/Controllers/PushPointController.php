<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use App\Http\Requests\PushPointRequest;
use App\Models\PushPointModel;
use App\Models\LikeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\AssignOp\Concat;

class PushPointController extends Controller
{
    public function Send(PushPointRequest $data)
    {
        $contacte = new PushPointModel();
        $contacte->top = $data->input('top');
        $contacte->allInform = $data->input('allInform');
        $contacte->coords = $data->input('coords');
        $contacte->typePoint = $data->input('typePoint');
        $contacte->avtor_id = Auth::user()->id;
        if ($data->file('image')) {
            $path = $data->file('image')->store('uploads', 'public');
            $url = asset('/storage/' . $path);
            $contacte->image = $url;
        } else {
            $contacte->image = "";
        }
        $contacte->save();
        return redirect()->route('pointPush');
    }

    public function pointPushAllData()
    {
        return view('pointPush', ['data' => PushPointModel::all(), 'like' => LikeModel::all(), 'avtor_id' => Auth::user()->id]);
    }

    public function deletPoint($id, $avtor_id,$forGetUrl)
    {
        if (!($avtor_id == Auth::user()->id))
            return redirect(route('mainWindos'))->withErrors(["error" => 'Вы пытаетесь удалить чужую запись']);

        if (!PushPointModel::find($id)) {
            return redirect()->route('pointPush');
        }
        if (PushPointModel::find($id)->image != "") {
            $foto = PushPointModel::find($id)->image;
            $nameFoto = explode("/", $foto);
            Storage::delete('/public/uploads/' . array_pop($nameFoto));
        }
        PushPointModel::find($id)->delete();
        LikeModel::where('post_id', '=', $id)->delete();
        return redirect()->route($forGetUrl);
    }

    public function likePoint($urlIn, $id_push, $avtor_id_push)
    {
        if (!($avtor_id_push == Auth::user()->id))
            return redirect(route('mainWindos'))->withErrors(["error" => 'Вы пытаетесь залайкать за чужой аккаунт']);

        $contacte = LikeModel::where([['avtor_id', '=', $avtor_id_push], ['post_id', '=', $id_push]])->get()->toArray();
        if (!empty($contacte)) {
            LikeModel::find($contacte[0]["id"])->delete();
            return redirect()->route($urlIn, ['data' => PushPointModel::all(), 'like' => LikeModel::all(), 'avtor_id' => Auth::user()->id]);
        } else {
            $newLike = new LikeModel();
            $newLike->avtor_id = $avtor_id_push;
            $newLike->post_id = $id_push;
            $newLike->save();
            return redirect()->route($urlIn, ['data' => PushPointModel::all(), 'like' => LikeModel::all(), 'avtor_id' => Auth::user()->id]);
        }
    }

    public function pointSeeAllData()
    {
        if (!empty(Auth::user()->id)) {
            return view('pointSee', ['data' => PushPointModel::all(), 'like' => LikeModel::all(), 'avtor_id' => Auth::user()->id]);
        } else {
            return view('pointSee', ['data' => PushPointModel::all(), 'like' => LikeModel::all()]);
        }
    }
}
