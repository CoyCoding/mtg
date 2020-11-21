<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  protected $hidden = ['pivot', 'created_at', 'updated_at'];

  public function cards(){
      return $this->hasMany('App\Models\Cards');
  }

  public static function findOrCreate($name){
    $rarity = self::where('name', $name)->first();

    if(!$rarity){
      $rarity = self::Create([
        'name' => $name,
      ]);
    }

    return $rarity;
  }
}
