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
      $cards = Http::get('https://api.magicthegathering.io/v1/cards?page=60')->json()['cards'][0];
      Card::CreateFromArray($cards);

  }
}
