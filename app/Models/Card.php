<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['types->id'];

    public function colors()
    {
      return $this->belongsToMany('App\Models\Color', 'card_colors');
    }

    public function sets(){
      return $this->belongsToMany('App\Models\Set', 'card_sets');
    }

    public function types(){
      return $this->belongsToMany('App\Models\Type', 'card_types');
    }

    public function supertypes(){
      return $this->belongsToMany('App\Models\Supertype', 'card_supertype');
    }

    public function subtypes(){
      return $this->belongsToMany('App\Models\Subtype', 'card_subtype');
    }
}
