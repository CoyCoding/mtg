<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Card;
use Illuminate\Support\Facades\Http;
use App\Helpers\QueryStringParser;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('scrape', function () {
  $page = 0;
  $time_pre = microtime(true);
  while(!empty($cards = Http::get('https://api.magicthegathering.io/v1/cards?page='.$page)->json()['cards']) && $page < 570){
    foreach($cards as $card){
      Card::CreateFromArray($card);
    }
    $time_post = microtime(true);
    $exec_time = $time_post - $time_pre;
    $this->comment('Page:'.$page.'Finished in: '.$exec_time.'---------');
    $page++;
  }
  $time_post = microtime(true);
  $exec_time = $time_post - $time_pre;
  $this->comment('---------Finished in: '.$exec_time.'---------');
})->purpose('Scrape and load database');

Artisan::command('detach', function () {
  while($card = Card::find(448)){
    $this->comment($card->supertypes()->detach());
    $this->comment($card->subtypes()->detach());
    $this->comment($card->types()->detach());
    $this->comment($card->colors()->detach());
    $this->comment($card->sets()->detach());
    $this->comment($card->delete());
  }
})->purpose('Display an inspiring quote');

// Get a card
Artisan::command('getcard', function () {
    $card = Card::get();
})->purpose('Display an inspiring quote');

// attach two flip cards
Artisan::command('flip', function () {
    // $card1 = Card::find(2367);
    // $card2 = Card::find(2368);
    // $card1->flipcard()->save($card2);
    // $card2->flipcard()->save($card1);
    // $this->comment($card1);
})->purpose('Display an inspiring quote');

// set tilt and attach two flip cards
Artisan::command('tilt', function () {
  $query = QueryStringParser::Card(['colors' => ['red']]);

  $pagedCards = Card::filterColorsBy($query['colors'], $query['searchCondition'])
    ->hasColumnId('rarity', $query['rarity'])->hasColumnId('types', $query['type'])
    ->hasColumnId('subtypes', $query['subtype'])->hasColumnId('supertypes', $query['supertype'])->paginate(30);
    $lastPage =  $cardsPaginated->lastPage();
    $currentPage = $cardsPaginated->currentPage();
    return $currentPage;
})->purpose('Display an inspiring quote');

Artisan::command('combine', function () {

})->purpose('Display an inspiring quote');