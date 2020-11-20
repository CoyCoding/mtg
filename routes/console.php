<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Card;
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

Artisan::command('detach', function () {
    $card = Card::where('id', '1')->first();
    $this->comment($card->supertypes()->detach());
    $this->comment($card->subtypes()->detach());
    $this->comment($card->types()->detach());
})->purpose('Display an inspiring quote');

Artisan::command('attach', function () {
    $card = Card::where('id', '1')->first();
    $this->comment($card->supertypes()->attach(1));
    $this->comment($card->subtypes()->attach(2));
    $this->comment($card->types()->attach(3));
})->purpose('Display an inspiring quote');

Artisan::command('getcard', function () {
    $card = Card::where('id', '1')->first();
    $this->comment(Card::with(['colors','subtypes', 'types', 'supertypes'])->get());
})->purpose('Display an inspiring quote');
