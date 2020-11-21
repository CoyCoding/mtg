<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameOnlyModel extends Model
{
  public static function findIdFromNameOrCreate($name){
    $found = self::where('name', $name)->first();

    if(!$found){
      $found = self::Create([
        'name' => $name,
      ]);
    }
    return $found['id'];
  }

  public static function findIdsFromNamesOrCreate($nameArr){
    $ids = [];
    foreach($nameArr as $name){
        $id = self::findIdFromNameOrCreate($name);
        array_push($ids, $id);
    }
    return $ids;
  }
}
