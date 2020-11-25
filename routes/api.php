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
  $queries = $request->query();
  $cards = Card::take(2)->get()->map(function($card) {
    return $card->format();
  });
  return $queries;
});
