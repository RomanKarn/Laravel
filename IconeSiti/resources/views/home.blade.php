@extends('layout.app')

@section('titel')
Main
@endsection

<!-- @section('header')
@auth("web")
<li><a href="">Личный кабенет</a>
    <ul class="topMenu_Submenu">
        <li><a href="{{route('loginOut')}}">Личный кабенет</a></li>
        <li><a href="{{route('loginOut')}}">Выйти</a></li>
    </ul>
</li>
@endauth

@guest("web")
<li><a href="{{route('login')}}">Войти</a></li>
<li><a href="{{route('registrat')}}">Регистрация</a></li>
@endguest

@endsection -->

@section('main')

@if($errors->any())
<div class="mapAndInput_Input_Error">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
<div class="homeContaner">
    <div class="homeContaner_top">ВотЗдесь - лучшие места от лучших людей</div>
    <div class="homeContaner_1_metca">&#128309; Этот цвет обозначает достопримечательности рукотворного происхождения.</div>
    <div class="homeContaner_2_metca">&#128994; Этот цвет обозначает достопримечательности природного происхождения.</div>
    <div class="homeContaner_3_metca">&#128308; Этот цвет обозначает опасные места для посещения.</div>
    <div class="homeContaner_metca_setting">
    <a href="{{route('pointPush')}}" class="homeContaner_Add_Met">Добавить метки</a>
    <a href="{{route('pointSee')}}"  class="homeContaner_See_Met">Посмотреть метки</a>
    </div>
</div>
@endsection