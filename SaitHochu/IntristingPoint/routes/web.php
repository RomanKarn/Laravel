<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('IntristingPoint/public/pointSee', function () {
    return view('pointSee');
});