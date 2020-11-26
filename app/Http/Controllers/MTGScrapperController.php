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
use App\Helpers\QueryStringParser;
class MTGScrapperController extends Controller
{
  public function index(){
    $data['rarities'] = Rarity::get();
    $data['supertypes'] = Supertype::get();
    $data['subtypes'] = Subtype::get();

    $data['types'] = Type::get();

    $data['colors'] = Color::get();
    return view('welcome')->with(['data' => $data]);
  }
}
