<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('mainWindos');


Route::get('/pointSee', 'App\Http\Controllers\PushPointController@pointSeeallData')->name('pointSee');

Route::get('/pointSee/send', 'App\Http\Controllers\PushPointController@allData')->name('allDataGet');

Route::middleware("auth")->group(function () {
    Route::get('/personalKabunetUdate/{id}', 'App\Http\Controllers\AvtorizatController@upDatePostStanId')->name('upDatePostStan');
    Route::get('/personalKabunetUdate', 'App\Http\Controllers\AvtorizatController@upDatePostStan')->name('upDatePost');
    Route::post('/personalKabunetUdate/update', 'App\Http\Controllers\AvtorizatController@upDatePostStanSend')->name('upDatePostStanSend');

    Route::get('/personalKabunet', 'App\Http\Controllers\AvtorizatController@inPersonalKabun')->name('personalKabunet');
    Route::get('/loginOut', 'App\Http\Controllers\AvtorizatController@showloginOutForm')->name('loginOut');


    Route::get('/pointPush', 'App\Http\Controllers\PushPointController@pointPushallData')->name('pointPush');
    Route::get('/{urlIn}/like/{id}/{avtor_id}', 'App\Http\Controllers\PushPointController@likePoint')->name('likePoint'); //Путь не менять иначе в pushPount сломается likePoint
    Route::get('/pointPush/delet/{id}/{avtor_id}/{forGetUrl}', 'App\Http\Controllers\PushPointController@deletPoint')->name('deletPoint'); //Путь не менять иначе в pushPount сломается delet
    Route::post('/pointPush/send', 'App\Http\Controllers\PushPointController@Send')->name('pointPushSend');
});

Route::middleware("guest")->group(function () {

    Route::get('/login', 'App\Http\Controllers\AvtorizatController@showLoginForm')->name('login');
    Route::post('/login/login_process', 'App\Http\Controllers\AvtorizatController@loginIn')->name('login_process');

    Route::get('/registrat', 'App\Http\Controllers\AvtorizatController@showregistratForm')->name('registrat');
    Route::post('/registrat/registrat_process', 'App\Http\Controllers\AvtorizatController@registration')->name('registrat_process');
});
