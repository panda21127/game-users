<?php

use Illuminate\Support\Facades\Route;

Route::post('/user/register', 'AuthController@register');

Route::post('/user/auth', 'AuthController@auth');

