<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Supertype;

class SeedSupertype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $supertypes = [
      ["name" =>"Basic"],
      ["name" =>"Host"],
      ["name" =>"Legendary"],
      ["name" =>"Ongoing"],
      ["name" =>"Snow"],
      ["name" =>"World"]
    ];

      foreach( $supertypes as $supertype)
      {
        Supertype::create($supertype);
      }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
