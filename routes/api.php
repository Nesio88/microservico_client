<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    ClientController
};

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::apiResource('clients', ClientController::class);