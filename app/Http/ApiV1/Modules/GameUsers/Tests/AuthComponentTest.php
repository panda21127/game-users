<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('POST /user/register 202', function () {
    $request = [
        "username" => "user1",
        "password" => "password",
    ];
    postJson('/user/register', $request)
        ->assertStatus(202);
});

test('POST /user/auth 200', function () {
    $request = [
        "username" => "user",
        "password" => "password",
    ];
    postJson('/user/auth', $request)
        ->assertStatus(200);
});

test('POST /user/register 400', function () {
    $request = [
        "username" => "user",
        "password" => "password",
    ];
    postJson('/user/register', $request)
        ->assertStatus(400);
});

test('POST /user/auth 401', function () {
    $request = [
        "username" => "user",
        "password" => "password_WRONG",
    ];
    postJson('/user/auth', $request)
        ->assertStatus(401);
});

test('POST /user/register 400 validation', function () {
    $request = [
        "username" => "user",
    ];
    postJson('/user/register', $request)
        ->assertStatus(400);
});

test('POST /user/auth 400 validation', function () {
    $request = [
        "username" => "user",
    ];
    postJson('/user/auth', $request)
        ->assertStatus(400);
});
