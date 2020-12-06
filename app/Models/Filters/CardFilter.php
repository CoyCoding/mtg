<?php

namespace App\Models\Filters;

use App\Models\Color;
use App\Models\User;

class CardFilter extends Filter
{
    /**
     * Filter by card Color.
     * Get all the Cards based on conditional and colors.
     *
     * @param $colorArray, $queries
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function colors($colors, $query){
        if($query->searchCondition == 'and'){
          return $this->builder->containsColors($colors);
        } else if($query->searchCondition == 'only'){
          return $this->builder->onlyColors($colors);
        }else if($query->searchCondition == 'or'){
          return $this->builder->bothColors($colors);
        } else {
          return $this->builder;
        }
    }

    /**
     * Filter by card Type.
     *
     * @param $typeName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function type($types){
      foreach($types as $type){
        $this->builder->whereHas('types', function ($query) use($type){
          $query->where('name', $type);
        });
      }
      return $this->builder;
    }

    /**
     * Filter by card subtype.
     *
     * @param $typeName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function subtype($type){
        return $this->builder->whereHas('subtypes', function ($query) use($type){
          $query->where('name', $type);
        });
    }

    /**
     * Filter by card supertype.
     *
     * @param $typeName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function supertype($type){
        return $this->builder->whereHas('supertypes', function ($query) use($type){
          $query->where('name', $type);
        });
    }

    /**
     * Filter by card Name.
     * Get all the Cards based on conditional and colors.
     *
     * @param $colorArray, $queries
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name, $queries){
        return $this->builder->where('name', 'like', '%'.$name.'%');
    }

    /**
    * returns query for all cards that have any of the selected colors
    *
    * ex. inupt [blue,black]
    * return blue-black, blue, and black.
    *  @param $colorArray
    *  @return \Illuminate\Database\Eloquent\Builder
    */
    private function bothColors($q, $colorsToFind =[]){
      $colors = Color::get()->pluck('name')->toArray();
      $colorsToRemove = array_udiff($colors, $colorsToFind,'strcasecmp');

      $this->builder->whereHas('colors', function($query) use($colorsToFind){
        $query->whereIn('name',  $colorsToFind);
      });

      $this->builder->whereDoesntHave('colors', function($query) use($colorsToRemove){
        $query->whereIn('name', $colorsToRemove);
      });

      return $this->builder;
    }

    /**
    * returns query for cards that contain all of the selected colors
    *
    * This query will include those that have other colors as as well
    * ex. inupt [blue,black]
    * return blue-black, blue-black-red, blue-black-white ect.
    *  @param  $colorArray
    *  @return \Illuminate\Database\Eloquent\Builder
    */
    private function containsColors($q, $nameArr =[]){
      foreach($nameArr as $color){
        $this->builder->whereHas('colors', function ($query) use($color){
          $query->where('name', $color);
        });
      }
      return $this->builder;
    }

    /**
    * Retuns query-Cards that only have selected colors
    *
    * This query will include those that have other colors as as well
    * ex. inupt [blue,black]
    * return blue-black, blue-black-red, blue-black-white ect.
    *  @param  $colorArray
    *  @return \Illuminate\Database\Eloquent\Builder
    */
    private function onlyColors($q, $colorsToFind = []){
      $colors = Color::get()->pluck('name')->toArray();
      $colorsToRemove = array_udiff($colors, $colorsToFind,'strcasecmp');

      // Filters out ALL cards if it has chosen color
      $this->builder->whereDoesntHave('colors', function($query) use($colorsToRemove){
        $query->whereIn('name', $colorsToRemove);
      });

      // Must be foreach not whereIn
      // Otherwise we get both colors seprate
      // ex. [red-white] returns only red-php_strip_whitespace
      foreach($colorsToFind as $color){
        $this->builder->whereHas('colors', function ($query) use($color){
          $query->where('name', $color);
        });
      }

      return $this->builder;
    }

}