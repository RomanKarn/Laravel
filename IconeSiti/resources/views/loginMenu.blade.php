@extends('layout.app')

@section('titel')
Login
@endsection

@section('header')
<h1>Login</h1>
<a href="{{route('mainWindos')}}">Главная</a>
@endsection

@section('main')

@if($errors->any())
<div class="mapAndInput_Input_Error">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
<div>
    <form class="rigistrated_Contaner" action="{{route('login_process')}}" method="post" class="">
        @csrf
        <div><input class="rigistrated_Contaner_Email" name="email" type="text" class="" placeholder="Почта" /></div>
        <div><input class="rigistrated_Contaner_Passsword" name="password" type="password" class="" placeholder="Пароль" /></div>
        <div>
            <a href="{{route('registrat')}}" class="">Регистрация</a>
        </div>
        <div><button class="rigistrated_Contaner_button" type="submit" class="">Войти</button></div>
    </form>
</div>
@endsection