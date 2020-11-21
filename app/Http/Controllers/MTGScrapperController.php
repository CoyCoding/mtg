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
    // $res =  Http::get('https://api.magicthegathering.io/v1/cards')->json()['cards'][0];
    //
    // $rarity = Rarity::where('name', $res['rarity'])->first();
    //
    // if(!$rarity){
    //   $rarity = Rarity::Create([
    //     'name' => $res['rarity'],
    //   ]);
    // }
    //
    // $colorIds = [];
    // foreach($res['colors'] as $color){
    //     $c = Color::where('name', $color)->first();
    //     if(!$c){
    //       $c = Color::create(['name' => $color]);
    //       error_log($color);
    //     }
    //     array_push($colorIds, $c['id']);
    // }
    //
    // $typeIds = [];
    // foreach($res['types'] as $type){
    //     $c = Type::where('name', $type)->first();
    //     if(!$c){
    //       $c = Type::create(['name' => $type]);
    //       error_log($type);
    //     }
    //     array_push($typeIds, $c['id']);
    // }
    //
    // $subtypeIds = [];
    // foreach($res['subtypes'] as $subtype){
    //     $c = Subtype::where('name', $subtype)->first();
    //     if(!$c){
    //       $c = Subtype::create(['name' => $subtype]);
    //       error_log($subtype);
    //     }
    //     error_log($c);
    //     array_push($subtypeIds, $c['id']);
    // }
    //
    // $supertypeIds = [];
    // foreach($res['supertypes'] as $supertype){
    //     $c = Supertype::where('name', $supertype)->first();
    //     if(!$c){
    //       $c = Subtype::create(['name' => $supertype]);
    //       error_log($supertype);
    //     }
    //     array_push($supertypeIds, $c['id']);
    // }
    //
    // $setIds = [];
    // foreach($res['printings'] as $set){
    //     $c = Set::where('name', $set)->first();
    //     if(!$c){
    //       $c = Set::create(['name' => $set]);
    //       error_log(json_encode($c));
    //     }
    //     array_push($setIds, $c['id']);
    // }
    //
    // $card = Card::Create([
    //   'name' => $res['name'],
    //   'mana_cost' => $res['manaCost'],
    //   'type_text' => $res['type'],
    //   'converted_mana_cost' => $res['cmc'],
    //   'rarity_id' => $rarity['id'],
    //   'text' => $res['text'],
    //   'artist' => $res['artist'],
    //   'power' => $res['power'] ?? null,
    //   'toughness' => $res['toughness'] ?? null,
    //   'layout' => $res['layout'],
    //   'image_url' => $res['imageUrl']
    // ]);
    //
    // $card->sets()->attach($setIds);
    // $card->supertypes()->attach($supertypeIds);
    // $card->subtypes()->attach($subtypeIds);
    // $card->types()->attach($typeIds);
    // $card->colors()->attach($colorIds);
    //
    //return $card;
    return Rarity::findOrCreate('rare');
    return json_encode(Card::find(1), JSON_UNESCAPED_SLASHES);
  }
}
