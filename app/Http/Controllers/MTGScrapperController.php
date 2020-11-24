<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Type;
use App\Models\Card;
use App\Models\Supertype;
use App\Models\Subtype;
use App\Models\Color;
use App\Models\Rarity;
use App\Models\Set;

class MTGScrapperController extends Controller
{
  public function index(){
    $cards = Card::onlyColors(['white','black'])->hasTypes(['artifact'])->get();
    $cards->format();
    //return response()->json($cards->format(), 200, [], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
  }
}
