<?php

namespace App\Helpers;
use Exception;

class QueryStringParser
{
  public static function card($request){
    try{
      $query = array();
      array_push($query, ['colors' => $request['colors'] ?? []]);
      array_push($query, ['rarity' => $request['rarity'] ?? null]);
      array_push($query, ['type' => $request['type'] ?? null]);
      array_push($query, ['subtype' => $request['subtype'] ?? null]);
      array_push($query, ['supertype' => $request['supertype'] ?? null]);
      array_push($query, ['searchCondition' => $request['searchCondition'] ?? null]);
    } catch(Exception $e){
      return $e;
    }

    return $query;
  }
}
