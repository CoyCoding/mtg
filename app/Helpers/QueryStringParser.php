<?php

namespace App\Helpers;


class QueryStringParser
{
  public static function card($request){
    $query = array();
    $query['colors'] = $request['colors'] ?? [];

    $query['rarity'] = $request['rarity'] ?? null;
    $query['type'] = $request['type'] ?? null;
    $query['subtype'] = $request['subtype'] ?? null;
    $query['supertype'] = $request['supertype'] ?? null;
    $query['searchCondition'] = $request['searchCondition'] ?? null;
    return $query;
  }
}
