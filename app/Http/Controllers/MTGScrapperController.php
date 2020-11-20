<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MTGScrapperController extends Controller
{

  public function index(){
    $client = new Client();
    $res = $client->request('GET', 'https://api.magicthegathering.io/v1/cards');

    echo $res->getStatusCode();


    return $res->getBody();
  }
}
