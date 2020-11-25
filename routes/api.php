<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Card;
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

Route::get('/get', function (Request $request) {
  $colors = $request->query('colors') ?? [];
  $searchCondition = $request->query('searchCondition') ?? '';
  $cards = Card::filterColorsBy($colors, $searchCondition)->get()->map(function($card) {
    return $card->format();
  });
  return $cards;
});
