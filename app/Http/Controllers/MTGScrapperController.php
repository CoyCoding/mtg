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
    $cards = Card::onlyColors(['white','black'])->hasTypes(['creature'])->first();
    return response()->json($cards, 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
  }
}
