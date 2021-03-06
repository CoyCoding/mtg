<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NameOnlyModel;

class Type extends NameOnlyModel
{
    protected $guarded = ['id'];
    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    use HasFactory;

    public function cards()
    {
      return $this->belongsToMany('App\Models\Card', 'card_types');
    }
}
