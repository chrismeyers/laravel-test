<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/ping', function () {
    return ['message' => 'pong'];
});

Route::middleware(['force.json', 'auth:api'])->group(function () {
    Route::get('/secret', function (Request $request) {
        return [
            'decoded_jwt' => json_decode(Auth::token()),
            'can_manage_account' => Auth::hasRole('account', 'manage-account')
        ];
    });
});
