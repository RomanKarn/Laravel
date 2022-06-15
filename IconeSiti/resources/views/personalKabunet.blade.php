@extends('layout.app')

@section('titel')
Main
@endsection

@section('main')
<div class="contanePersonalKabinet">
    <div class="contanePersonalKabinet_Post">
        <div class="contanePersonalKabinet-contane">
            <a href="#" class="contanePersonalKabinet_Post-Name">Название:</a>
            <a href="#" class="contanePersonalKabinet_Post-allInform">Текст:</a>
            <a href="#" class="contanePersonalKabinet_Post-like">Лайки:</a>
            <a href="#" class="contanePersonalKabinet_Post-image">Картинки:</a>
        </div>
    </div>
    @foreach($data as $post)
    <div class="contanePersonalKabinet_Post">
        <div class="contanePersonalKabinet-contane">
            <div class="contanePersonalKabinet_Post-Name">{{$post['top']}}</div>
            <div class="contanePersonalKabinet_Post-allInform">{{$post['allInform']}}</div>
            <div class="contanePersonalKabinet_Post-like">Колличество лаков: {{$post['valuLike']}}</div>
            @if(!empty($post['image']))
            <div class="contanePersonalKabinet_Post-image"><img src="{{$post['image']}}" style="width: 150px; height:200px" alt=""></div>
            @endif
        </div>
        <div class="contanePersonalKabinet_Setting">
            <a href="{{route('upDatePostStan',[$post['id']])}}" class="contanePersonalKabinet_Setting-Update">Изменить</a>
            <a href="{{route('deletPoint',[$post['id'],$post['avtor_id'],'personalKabunet'])}}" class="contanePersonalKabinet_Setting-Delet">Удалить</a>
        </div>
    </div>

    @endforeach
</div>
@endsection