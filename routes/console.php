<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Card;
use Illuminate\Support\Facades\Http;
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
//
Artisan::command('getcard', function () {
    $card = Card::where('name', 'test')->first();
    $this->comment($card);
})->purpose('Display an inspiring quote');

// //card where has
// Artisan::command('getcardwith', function () {
//     $card = Card::where('id', '4')->hasSubtypes(['adventure'])->get();
//     $this->comment(!$card);
// })->purpose('Display an inspiring quote');
//
// Artisan::command('createwith', function () {
//     $card = Card::create(['name' => 'test2']);
//     $this->comment($card->supertypes()->attach(6));
//     $this->comment($card->subtypes()->attach(5));
//     $this->comment($card->types()->attach(5));
//     $this->comment($card->colors()->attach(5));
//     $this->comment($card);
// })->purpose('Display an inspiring quote');
//
//
