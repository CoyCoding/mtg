<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Card extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['flipcard_id', 'rarity_id', 'updated_at', 'created_at'];
    protected $with = ['colors','subtypes', 'types', 'supertypes', 'sets', 'rarity'];

    public static function CreateFromArray($res){
        // Find Relationship Ids
        $rarity = Rarity::findIdFromNameOrCreate($res['rarity']);
        $colorIds = Color::findIdsFromNamesOrCreate($res['colors']);
        $typeIds = Type::findIdsFromNamesOrCreate($res['types']);
        $subtypeIds = Subtype::findIdsFromNamesOrCreate($res['subtypes']);
        $supertypeIds = Supertype::findIdsFromNamesOrCreate($res['supertypes']);
        $setIds = Set::findIdsFromNamesOrCreate($res['printings']);

        //
        // There are duplicate cards
        // Most I saw are missing images so this will compile them into one
        //
        $card = self::where('name', $res['name'])->first();

        if($card){
          $card->image_url = $res['imageUrl'] ?? $card->image_url;
          $card->save();
        }else{
          $card = self::Create([
            'name' => $res['name'] ?? '',
            'mana_cost' => $res['manaCost'] ?? '',
            'type_text' => $res['type'] ?? '',
            'converted_mana_cost' => $res['cmc'] ?? 0,
            'rarity_id' => $rarity,
            'text' => $res['text'] ?? '',
            'artist' => $res['artist'] ?? '',
            'power' => $res['power'] ?? '',
            'toughness' => $res['toughness'] ?? '',
            'layout' => $res['layout'] ?? '',
            'image_url' => $res['imageUrl'] ?? ''
          ]);
        }
        $card->fliped()->sync([]);
        $card->sets()->sync($setIds);
        $card->supertypes()->sync($supertypeIds);
        $card->subtypes()->sync($subtypeIds);
        $card->types()->sync($typeIds);
        $card->colors()->sync($colorIds);

      return $card;
    }

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
      return $this->belongsTo('App\Models\Rarity', 'rarity_id');
    }

    public function flipcard(){
      return $this->hasOne('App\Models\Card', 'flipcard_id');
    }

    // returns query with selected subtype names
    public function scopeHasSubtypes($q, $nameArr = []){
        return $q->whereHas('subtypes', function ($query) use($nameArr){
          $query->whereIn('name', $nameArr, $boolean, $not);
        });
    }

    // returns query with selected type names
    public function scopeHasTypes($q, $nameArr = []){
        return $q->whereHas('types', function ($query) use($nameArr){
          $query->whereIn('name', $nameArr);
        });
    }

    // returns query with selected supertype names
    public function scopeHasSupertypes($q, $nameArr = []){
        return $q->whereHas('supertypes', function ($query) use($nameArr){
          $query->whereIn('name', $nameArr);
        });
    }

    // returns query for all cards that have any of the selected colors
    //
    // ex. inupt [blue,black]
    // return blue-black, blue, and black.
    //
    protected function scopeBothColors($q, $colorsToFind =[]){
      $colors = Color::get()->pluck('name')->toArray();
      $colorsToRemove = array_udiff($colors, $colorsToFind,'strcasecmp');

      $q->whereHas('colors', function($query) use($colorsToFind){
        $query->whereIn('name',  $colorsToFind);
      });

      $q->whereDoesntHave('colors', function($query) use($colorsToRemove){
        $query->whereIn('name', $colorsToRemove);
      });

      return $q;
    }

    // returns query for cards that contain all of the selected colors
    //
    // This query will include those that have other colors as as well
    // ex. inupt [blue,black]
    // return blue-black, blue-black-red, blue-black-white ect.
    //
    protected function scopeContainsColors($q, $nameArr =[]){
      foreach($nameArr as $color){
        $q->whereHas('colors', function ($query) use($color){
          $query->where('name', $color);
        });
      }
      return $q;
    }

    // Retuns query-Cards that only have selected colors
    protected function scopeOnlyColors($q, $colorsToFind = []){
      $colors = Color::get()->pluck('name')->toArray();
      $colorsToRemove = array_udiff($colors, $colorsToFind,'strcasecmp');

      // Filters out ALL cards if it has chosen color
      $q->whereDoesntHave('colors', function($query) use($colorsToRemove){
        $query->whereIn('name', $colorsToRemove);
      });

      // Must be foreach not whereIn
      // Otherwise we get both colors seprate
      // ex. [red-white] returns only red-php_strip_whitespace
      foreach($colorsToFind as $color){
        $q->whereHas('colors', function ($query) use($color){
          $query->where('name', $color);
        });
      }

      return $q;
    }

    // returns query with selected set names
    public function scopeHasSets($q, $nameArr = []){
        return $q->whereHas('sets', function ($query) use($nameArr){
          return $query->whereIn('name', $nameArr);
        });
    }

    public function scopeFilterColorsBy($q, $nameArr = [], $condition){
      if($condition == 'and'){
        return $q->containsColors($nameArr);
      } else if($condition == 'only'){
        return $q->onlyColors($nameArr);
      }else if($condition == 'or'){
        return $q->bothColors($nameArr);
      } else {
        return $q;
      }
    }

    public function scopeHasColumnId($q, $column, $typeId){
      if(!$typeId) return $q;
      return $q->whereHas($column, function ($query) use($typeId){
        $query->where('name', $typeId);
      });
    }

    public function format(){
      $this->setRelation('colors', $this->colors->pluck('name'));
      $this->setRelation('subtypes', $this->subtypes->pluck('name'));
      $this->setRelation('types', $this->types->pluck('name'));
      $this->setRelation('supertypes', $this->supertypes->pluck('name'));
      $this->setRelation('sets', $this->sets->pluck('name'));
      $this->attributes['rarity'] = $this->rarity->attributes['name'];
      $this->unsetRelation('rarity');

      return $this;
    }
}
