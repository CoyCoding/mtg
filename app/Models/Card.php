<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cardColors()
    {
      return $this->belongsToMany('App\Models\Color', 'card_color');
    }
}
