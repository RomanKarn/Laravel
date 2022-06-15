<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <title>@yield('titel')</title>
</head>

<body>
    <header class="header">
        <div class="contaner">
            <nav>
                <ul class="topMenu">
                    <div class="leftMoveTop">
                        <li><a href="{{route('mainWindos')}}">Главная</a></li>
                        <li><a href="{{route('pointPush')}}">Добавить метки</a></li>
                        <li><a href="{{route('pointSee')}}">Посмотреть метки</a></li>
                    </div>
                    <div class="rithgMoveTop">
                        @auth("web")
                        <li><a href="{{route('personalKabunet')}}">Личный кабенет</a>
                            <ul class="topMenu_Submenu">
                                <li><a href="{{route('loginOut')}}">Выйти</a></li>
                            </ul>
                        </li>
                        @endauth
                        @guest("web")

                        <li><a href="{{route('login')}}">Войти</a></li>
                        <li><a href="{{route('registrat')}}">Регистрация</a></li>
                        @endguest
                    </div>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main">
        <div class="contaner">
            @yield('main')
        </div>
    </main>
</body>

</html>