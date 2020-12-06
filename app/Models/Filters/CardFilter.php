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
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function colors($colors, $query)
    {
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
    * returns query for all cards that have any of the selected colors
    *
    * ex. inupt [blue,black]
    * return blue-black, blue, and black.
    *  @param $username
    *  @return \Illuminate\Database\Eloquent\Builder
    */
    protected function bothColors($q, $colorsToFind =[]){
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

    // returns query for cards that contain all of the selected colors
    //
    // This query will include those that have other colors as as well
    // ex. inupt [blue,black]
    // return blue-black, blue-black-red, blue-black-white ect.
    //
    protected function containsColors($q, $nameArr =[]){
      foreach($nameArr as $color){
        $this->builder->whereHas('colors', function ($query) use($color){
          $query->where('name', $color);
        });
      }
      return $this->builder;
    }

    // Retuns query-Cards that only have selected colors
    protected function onlyColors($q, $colorsToFind = []){
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