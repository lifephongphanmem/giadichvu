<?php

// use App\Http\Controllers\APIController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('doanhnghiep','APIController@DoanhNghiep');
Route::post('hosokekhai','APIController@HoSoKeKhai');
// Route::post('doanhnghiep', [APIController::class, 'DoanhNghiep']);
// Route::post('hosokekhai', [APIController::class, 'HoSoKeKhai']);

