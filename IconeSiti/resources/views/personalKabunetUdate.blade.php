@extends('layout.app')

@section('titel')
Main
@endsection

@section('main')
<div class="contanePersonalKabinet">
    <form action="{{route('upDatePostStanSend')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input hidden type="text" name="id" id="id" value="{{$data['id']}}">
        <input hidden type="text" name="coords" id="coords" value="{{$data['coords']}}">
        <div class="mapAndInput_Input_Top">
            <select class="mapAndInput_Input_Top_Selectop" id="typePoint" name="typePoint">
                @if($data['typePoint']=="blue")
                <option value="blue" class="mapAndInput_Input_Top_Selectop-blue" selected>&#128309;</option>
                @else
                <option value="blue" class="mapAndInput_Input_Top_Selectop-blue">&#128309;</option>
                @endif
                @if($data['typePoint']=="green")
                <option value="green" class="mapAndInput_Input_Top_Selectop-green" selected>&#128994;</option>
                @else
                <option value="green" class="mapAndInput_Input_Top_Selectop-green">&#128994;</option>
                @endif
                @if($data['typePoint']=="red")
                <option value="red" class="mapAndInput_Input_Top_Selectop-red" selected>&#128308;</option>
                @else
                <option value="red" class="mapAndInput_Input_Top_Selectop-red">&#128308;</option>
                @endif

            </select>
            <input required type="text" name="top" id="top" placeholder="Заголовок" maxlength=30 size=50 class="mapAndInput_Input_Top_Text" value="{{$data['top']}}">
        </div>
        <textarea required name="allInform" id="allInform" placeholder="Описание" maxlength=300 cols="30" rows="10" class="mapAndInput_Input_AllInform">{{$data['allInform']}}</textarea>
        <input type="file" name="image" id="image" class="mapAndInput_Input_Imag" accept="image/jpeg,image/png">
        <button type="submit" class="mapAndInput_Input_Button">Отправить</button>
    </form>
</div>
@endsection