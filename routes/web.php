<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//webでもAPIでもいい
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
    
    //認証に対して権限を追加できる。
    //return $user->createToken('token-name', ['server:update'])->plainTextToken;

    //サーバーアップデートの権限が存在すれば。。。
    // if ($user->tokenCan('server:update')) {
    //     //
    // }
});

//認証なしで呼び出されたら困るもののグループ化
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});