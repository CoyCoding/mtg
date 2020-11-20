<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function colors()
    {
      return $this->belongsToMany('App\Models\Color', 'card_color');
    }

    public function sets(){
      return $this->belongsToMany('App\Models\Set', 'card_set');
    }

    public function types(){
      return $this->belongsToMany('App\Models\Type', 'card_type');
    }

    public function supertypes(){
      return $this->belongsToMany('App\Models\Type', 'card_supertype');
    }

    public function subtypes(){
      return $this->belongsToMany('App\Models\Type', 'card_subtype');
    }
}
