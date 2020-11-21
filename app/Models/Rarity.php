<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NameOnlyModel;

class Rarity extends NameOnlyModel
{
  use HasFactory;

  protected $guarded = ['id'];
  protected $hidden = ['pivot', 'created_at', 'updated_at'];

  public function cards(){
      return $this->hasMany('App\Models\Cards');
  }

}
