<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Card;
use App\Helpers\QueryStringParser;
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

// Accepts QueryString with :
//
//  -colors array
//  -rarity string
//  -type string
//  -subtype string
//  -supertype string
//  -searchCondition string
Route::get('/get', function (Request $request) {
  try{
    QueryStringParser::Card($request->query());

    return Card::filterColorsBy($colors, $searchCondition)
      ->hasColumnId('rarity', $rarity)->hasColumnId('type', $type)
      ->hasColumnId('subtype', $subtype)->hasColumnId('supertype', $supertype)
      ->get()->map(function($card) {
        return $card->format();
    });
  } catch(Exception $e) {
    return $e;
  }
});
