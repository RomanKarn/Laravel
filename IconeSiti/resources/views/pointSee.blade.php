@extends('layout.app')

@section('titel')
Main
@endsection

<!-- @section('header')
<h1>PoinSee</h1>
<a href="{{route('mainWindos')}}">Главная</a>

@auth("web")
<a href="{{route('pointPush')}}">Добавить метки</a>
<a href="{{route('loginOut')}}">Выйти</a>
@endauth

@guest("web")
<a href="{{route('login')}}">Войти</a>
<a href="{{route('registrat')}}">Регистрация</a>
@endguest
@endsection -->

@section('main')

<div class="mapAndInput">
    <div class="mapAndInput_Map">
        <div class="mapAndInput_Map_Filter">
            <form name="Filter">
                <select class="mapAndInput_Map_Filter_Selectop" id="typePoint_Filter" name="typePoint_Filter">
                    <option value="my" class="mapAndInput_Map_Filter_Selectop-my">Мои записи</option>
                    <option value="likeColl" class="mapAndInput_Map_Filter_Selectop-red">По количеству лайков</option>
                    <option value="len" class="mapAndInput_Map_Filter_Selectop-red">По растоянию от вас</option>
                    <option value="all" class="mapAndInput_Map_Filter_Selectop-all" selected>&#128309;&#128994;&#128308;</option>
                    <option value="blue" class="mapAndInput_Map_Filter_Selectop-blue">&#128309;</option>
                    <option value="green" class="mapAndInput_Map_Filter_Selectop-green">&#128994;</option>
                    <option value="red" class="mapAndInput_Map_Filter_Selectop-red">&#128308;</option>
                </select>
            </form>
            <div name="likeCollContan" id="likeCollContan" class="filter_Like_Coll_Contan">
                <input type="text" name="likeCollContan_likeColl" id="likeCollContan_likeColl" placeholder="=>0">
                <button type="" name="likeCollContanSend" id="likeCollContanSend" class="">Отправить</button>
            </div>
        </div>

        <div id="map" class="mapAndInput_Map-MAP"></div>

        <script type="text/javascript">
            var app = <?php echo json_encode($data); ?>;
            var avtor_id = <?php
                            if (!empty($avtor_id)) {
                                echo json_encode($avtor_id);
                            } else {
                                echo "-666";
                            }

                            ?>;
            var like = <?php echo json_encode($like); ?>;
            var recoverFilter = document.getElementById("typePoint_Filter");
            var myMap, myPlacemark, geolocation;
            var pointLocashion = [55.753994, 37.622093];

            ymaps.ready(init);

            function init() {
                if (myMap) {
                    myMap.destroy();
                    myMap = null;
                }

                //ЭТО РАБОТАТ НО НЕ РАБОТЕТЕТ ПОТОМУЧТО HPPTS НУЖЕН
                // if (navigator.geolocation) {
                //     // var pointLocashion = navigator.geolocation.getCurrentPosition();
                //     // console.log(position.coords.latitude);
                //     // console.log(position.coords.longitude);
                // } else {
                //     pointLocashion =[55.753994, 37.622093];
                // }

                myMap = new ymaps.Map('map', {
                    center: pointLocashion,
                    zoom: 9,
                    controls: ['zoomControl', 'fullscreenControl']
                }, {
                    searchControlProvider: 'yandex#search'
                });

                myMap.geoObjects.add(new ymaps.Placemark(pointLocashion, {
                    balloonContent: 'вы тут'
                }, {
                    preset: 'islands#circleDotIcon',
                    iconColor: 'red'
                }));

                //Генерация меток
                var myCollection = new ymaps.GeoObjectCollection();
                for (i = 0; i < app.length; i++) {
                    myCollection.add(createPlacemark(app[i]));
                }
                myMap.geoObjects.add(myCollection);

                // Создание метки полноценных меток.
                function createPlacemark(element) {
                    cord = [Number(element['coords'].split(',')[0]), Number(element['coords'].split(',')[1])];
                    color = 'islands#' + element['typePoint'] + 'Icon';
                    urlFoto = "";
                    if (element['image']) {
                        urlFoto = '<img src="';
                        urlFoto += element['image'];
                        urlFoto += '"';
                        urlFoto += 'style="width: 150px; height:200px"  alt="">';
                    }
                    console.log(element['avtor_id']);
                    if (avtor_id !== element['avtor_id']) {
                        var colorLike = "💙";
                        var valueLike = 0;
                        for (const likeElement of like) {
                            if (likeElement['post_id'] === element["id"] && likeElement['avtor_id'] === avtor_id)
                                colorLike = "❤️";

                            if (likeElement['post_id'] === element["id"])
                                valueLike++;
                        }
                        stringUrl = 'http://iconesiti/pointSee/like/' + element["id"] + '/' + avtor_id
                        urls = new URL(stringUrl);

                        return new ymaps.Placemark(cord, {
                            balloonContentHeader: element['top'],
                            balloonContentBody: urlFoto + "<div>" + element['allInform'] + "</div>",
                            balloonContentFooter: '<div style="display:flex; justify-content:space-between; " >' + "Количестко лаков: " + valueLike + ' <a " href="' + urls + '">' + colorLike + '<a/>' + "</div>"
                        }, {
                            preset: color,
                        });
                    } else {
                        var colorLike = "";
                        var valueLike = 0;
                        for (const likeElement of like) {
                            if (likeElement['post_id'] === element["id"] && likeElement['avtor_id'] === avtor_id)
                                colorLike = "";

                            if (likeElement['post_id'] === element["id"])
                                valueLike++;
                        }
                        stringUrl = 'http://iconesiti/pointSee/like/' + element["id"] + '/' + avtor_id
                        urls = new URL(stringUrl);

                        return new ymaps.Placemark(cord, {
                            balloonContentHeader: element['top'],
                            balloonContentBody: urlFoto + "<div>" + element['allInform'] + "</div>",
                            balloonContentFooter: '<div style="display:flex; justify-content:space-between; " >' + "Количестко лаков: " + valueLike + ' <a " href="' + urls + '">' + colorLike + '<a/>' + "</div>"
                        }, {
                            preset: color,
                        });
                    }

                }

                // Создание метки полноценных меток.
                function createClickPlacemark(cord) {
                    return new ymaps.Placemark(cord, {}, {
                        preset: 'islands#grayIcon',
                    });
                }

            }

            recoverFilter.addEventListener("change", lisiningEvent);

            likeCollContanSend.addEventListener("click", UpDateCriatMap);

            function lisiningEvent() {
                if ((typePoint_Filter.value !== "likeColl") && (typePoint_Filter.value !== "len")) {
                    let headingElement = document.querySelector('#likeCollContan');
                    headingElement.style.display = 'none'
                    UpDateCriatMap();
                } else {
                    let headingElement = document.querySelector('#likeCollContan');
                    headingElement.style.display = 'flex'
                    headingElement.style.display = 'flex'
                }
            }
            function UpDateCriatMap() {
                ymaps.ready(init);

                function init() {
                    if (myMap) {
                        myMap.destroy();
                        myMap = null;
                    }

                    myMap = new ymaps.Map('map', {
                        center: pointLocashion,
                        zoom: 9,
                        controls: ['zoomControl', 'fullscreenControl']
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                    myMap.geoObjects.add(new ymaps.Placemark(pointLocashion, {
                        balloonContent: 'Вы тут'
                    }, {
                        preset: 'islands#circleDotIcon',
                        iconColor: 'red'
                    }));
                    
                    //Генерация меток
                    var myCollection = new ymaps.GeoObjectCollection();
                    for (i = 0; i < app.length; i++) {
                        if (typePoint_Filter.value === 'all') {
                            myCollection.add(createPlacemark(app[i]));
                            continue;
                        }
                        if (typePoint_Filter.value === 'my') {
                            if (avtor_id === app[i]['avtor_id']) {
                                myCollection.add(createPlacemark(app[i]));
                            }
                        }
                        if (typePoint_Filter.value === app[i]['typePoint']) {
                            myCollection.add(createPlacemark(app[i]));
                        }
                        if (typePoint_Filter.value === 'likeColl') {
                            var valueLike = 0;
                            for (const likeElement of like) {
                                if (likeElement['post_id'] === app[i]["id"])
                                    valueLike++;
                            }
                            if (valueLike >= likeCollContan_likeColl.value) {
                                myCollection.add(createPlacemark(app[i]));
                            }
                        }
                        if (typePoint_Filter.value === 'len') {
                            cord = [Number(app[i]['coords'].split(',')[0]), Number(app[i]['coords'].split(',')[1])];
                            var lenXY = Math.sqrt(Math.pow(pointLocashion[0] - cord[0], 2) + Math.pow(pointLocashion[1] - cord[1], 2))
                            console.log(lenXY*100000)
                            if (likeCollContan_likeColl.value >= lenXY*100000) {
                                myCollection.add(createPlacemark(app[i]));
                            }
                        }
                    }
                    myMap.geoObjects.add(myCollection);

                    // Создание метки полноценных меток.
                    function createPlacemark(element) {
                        cord = [Number(element['coords'].split(',')[0]), Number(element['coords'].split(',')[1])];
                        color = 'islands#' + element['typePoint'] + 'Icon';
                        urlFoto = "";
                        if (element['image']) {
                            urlFoto = '<img src="';
                            urlFoto += element['image'];
                            urlFoto += '"';
                            urlFoto += 'style="width: 150px; height:200px"  alt="">';
                        }
                        if (avtor_id !== element['avtor_id']) {
                            var colorLike = "💙";
                            var valueLike = 0;
                            for (const likeElement of like) {
                                if (likeElement['post_id'] === element["id"] && likeElement['avtor_id'] === avtor_id)
                                    colorLike = "❤️";

                                if (likeElement['post_id'] === element["id"])
                                    valueLike++;
                            }
                            stringUrl = 'http://iconesiti/pointPush/like/' + element["id"] + '/' + avtor_id
                            urls = new URL(stringUrl);

                            return new ymaps.Placemark(cord, {
                                balloonContentHeader: element['top'],
                                balloonContentBody: urlFoto + "<div>" + element['allInform'] + "</div>",
                                balloonContentFooter: '<div style="display:flex; justify-content:space-between; " >' + "Количестко лаков: " + valueLike + ' <a  href="' + urls + '">' + colorLike + '<a/>' + "</div>"
                            }, {
                                preset: color,
                            });
                        } else {
                            var colorLike = "";
                            var valueLike = 0;
                            for (const likeElement of like) {
                                if (likeElement['post_id'] === element["id"] && likeElement['avtor_id'] === avtor_id)
                                    colorLike = "";

                                if (likeElement['post_id'] === element["id"])
                                    valueLike++;
                            }

                            return new ymaps.Placemark(cord, {
                                balloonContentHeader: element['top'],
                                balloonContentBody: urlFoto + "<div>" + element['allInform'] + "</div>",
                                balloonContentFooter: '<div style="display:flex; justify-content:space-between; " >' + "Количестко лаков: " + valueLike + "</div>"
                            }, {
                                preset: color,
                            });
                        }
                    }

                    // Создание метки полноценных меток.
                    function createClickPlacemark(cord) {
                        return new ymaps.Placemark(cord, {}, {
                            preset: 'islands#grayIcon',
                        });
                    }

                }
            }
        </script>
    </div>
</div>
@endsection