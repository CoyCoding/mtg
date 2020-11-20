<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function cards()
  {
      return $this->hasMany('App\Models\Cards');
  }
}
