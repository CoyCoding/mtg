<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Card;
use App\Helpers\QueryStringParser;
use App\Http\Controllers\Api\CardController;
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
Route::apiResource('get', CardController::class, [
       'only' => [
           'index'
       ]
]);

Route::get('/byname', function(Request $request){
  $query = QueryStringParser::Card($request->query());
  try{
    return Card::where('name', 'like', '%'.$query['name'].'%')->take(4)->get();
  }catch(Exception $e){
    return $e;
  }
});
