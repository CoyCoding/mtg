<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = [];
    protected $with = ['colors','subtypes', 'types', 'supertypes', 'sets', 'rarity'];

    public function colors(){
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

    public function rarity(){
      return $this->belongsTo('App\Models\Rarity');
    }

    // returns query with selected subtype names
    public function scopeHasSubtypes($q, $nameArr){
        return $q->whereHas('subtypes', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }

    // returns query with selected type names
    public function scopeHasTypes($q, $nameArr){
        return $q->whereHas('types', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }

    // returns query with selected supertype names
    public function scopeHasSupertypes($q, $nameArr){
        return $q->whereHas('supertypes', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }

    // returns query with selected color names
    public function scopeHasColors($q, $nameArr){
        return $q->whereHas('colors', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }

    // returns query with selected set names
    public function scopeHasSets($q, $nameArr){
        return $q->whereHas('sets', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }


}
