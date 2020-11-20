<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cards()
    {
      return $this->belongsToMany('App\Models\Card', 'card_color');
    }
}
